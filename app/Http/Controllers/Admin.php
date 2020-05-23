<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Admin extends Controller
{
    public function index()
    {
        $nb_user = DB::table("users")->count("id");
        $nb_commande = DB::table("commande")->count("id");
        $nb_avis = DB::table("commentaire")->count("id");
        return view('adm/adm_home',compact('nb_user','nb_avis','nb_commande'));
    }

    public function horaires()
    {
        $fermetures = DB::table('fermeture')->select('*')->get();
        $feriees = DB::table('feriee')->select('*')->get();
        $horaires = DB::table('horaires')->select('*')->get();
        return view('adm/adm_horaires',compact('horaires','fermetures', 'feriees'));
    }

    public function horaires_modif(Request $request)
    {
        $validate_data = Validator::make($request->all(), [
            'midi_modif' => 'required|string',
            'soir_modif' => 'required|string'
        ]);
        if($validate_data->fails()){
            return back()->with('error',"Il y a une erreur avec la modification de votre horaire.");
        }

        DB::table('horaires')->where('id','=',$request['id_modif'])->update([
           'midi' => $request['midi_modif'],
            'soir' => $request['soir_modif']
        ]);

        return back()->with('message',"Votre horaire a été modifié.");
    }

    public function feriee_ajout(Request $request)
    {
        $validate_data = Validator::make($request->all(), [
            'jour' => 'required|string',
            'midi' => 'required|string',
            'soir' => 'required|string'
        ]);

        if($validate_data->fails()){
            return back()->with('error',"Il y a une erreur avec la création de votre jour fériée.");
        }

        DB::table('feriee')->updateOrInsert([
            'jour' => $request['jour'],
            'midi' => $request['midi'],
            'soir' => $request['soir']
        ]);

        return back()->with('message', 'Votre jour fériée à bien été enregistré!');
    }

    public function feriee_supprimer(Request $request)
    {
        DB::table('feriee')->where('id','=',$request['id'])->delete();
    }

    public function fermeture_ajout(Request $request)
    {
        $validate_data = Validator::make($request->all(), [
            'dateDeb' => 'required|date',
            'dateFin' => 'required|date',
            'motif' => 'required|string'
        ]);

        if($validate_data->fails()){
            return back()->with('error',"Il y a une erreur avec la création de votre fermeture.");
        }

        DB::table('fermeture')->updateOrInsert([
            'date_debut' => $request['dateDeb'],
            'date_fin' => $request['dateFin'],
            'motif' => $request['motif']
        ]);

        return back()->with('message', 'Votre période de fermeture à bien été enregistré!');
    }

    public function fermeture_supprimer(Request $request)
    {
        DB::table('fermeture')->where('id','=',$request['id'])->delete();
    }

    public function avis(Request $request)
    {
        $choix = $request["choix"];
        if($choix == "moins") {
            $com = DB::table('commentaire')
                ->orderBy('note', 'asc')
                ->paginate(5);
        }
        else if ($choix == "mieux") {
            $com = DB::table('commentaire')
                ->orderBy('note', 'desc')
                ->paginate(5);
        }
        else {
            $com = DB::table("commentaire")
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        }
        $com->withPath('avis?choix='.$choix);
        return view('adm/adm_avis')->with("commentaires", $com);
    }

    public function supprimer_avis(Request $request)
    {
        DB::table('commentaire')->where('id','=',$request['id'])->delete();
    }

    public function general()
    {
        $parametres = DB::table('parametres')->where('id', 1)->get();
        return view('adm/adm_general')->with('parametres', $parametres);
    }

    public function identite(Request $request)
    {
        $path = base_path('config/app.php');

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "'name' => '" . config('app.name') . "'", "'name' => '" . $request['nomPizzeria'] . "'", file_get_contents($path)
            ));

            file_put_contents($path, str_replace(
                "'url' => '" . config('app.url') . "'", "'url' => '" . $request['lienSite'] . "'", file_get_contents($path)
            ));
        }

        return back()->with('message', 'L\'identité a bien été enregistré.');
    }

    public function telephone(Request $request)
    {
        DB::table('parametres')->where('id','=','1')->update([
            'telephone' => $request['num']
        ]);

        return back()->with('message', 'Le numéro a bien été modfié.');
    }

    public function images(Request $request)
    {
        $banName = time().'.'. $request->baniere->extension();
        $banName1 = 'images/'.$banName;
        $logoName = time()+1 .'.'. $request->logo->extension();
        $logoName1 = 'images/'.$logoName;

        $path = base_path('config/images.php');

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "'baniere' => '" . config('images.baniere') . "'", "'baniere' => '" . $banName1 . "'", file_get_contents($path)
            ));

            file_put_contents($path, str_replace(
                "'logo' => '" . config('images.logo') . "'", "'logo' => '" . $logoName1 . "'", file_get_contents($path)
            ));
        }

        $request->baniere->move(public_path('images'), $banName);
        $request->logo->move(public_path('images'), $logoName);

        return back()->with('message', 'Les images ont bien été enregistré.');
    }

    public function adresse(Request $request)
    {
        DB::table('parametres')->where('id','=','1')->update([
            'adresse' => $request['adresse'],
            'codePostal' => $request['cp'],
            'ville' => $request['ville']

        ]);

        return back()->with('message', 'L\'adresse a bien été modifié.');
    }

    public function couleurs(Request $request)
    {
        $path = base_path('config/couleurs.php');

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "'" . $request['colorInput'] . "' => '" . config('couleurs.' . $request['colorInput']) . "'", "'" . $request['colorInput'] . "' => '" . $request['valeurInput'] . "'", file_get_contents($path)
            ));
        }

        return back()->with('message', 'La couleur a bien été modifié.');
    }

    public function engagements()
    {
        $engagements = DB::table('engagement')->select('*')->get();
        return view('adm/adm_engagements')->with('engagements', $engagements);
    }

    public function page_accueil()
    {
        $carousel=DB::table('accueil_carousel')->select('*')->get();
        $partenaires = DB::table('partenaires')->select('*')->get();
        $parametres = DB::table('parametres')->where('id', 1)->get();
        return view('adm/adm_page_accueil',compact('carousel','partenaires', 'parametres'));
    }

    public function partenaire_ajout(Request $request)
    {
        DB::table('partenaires')->updateOrInsert([
            'nom' => $request['nom'],
            'lien' => $request['lien']
        ]);

        return redirect('admin/secondaire');
    }

    public function partenaire_supprimer(Request $request)
    {
        DB::table('partenaires')->where('id','=',$request['id'])->delete();
    }

    public function afficher_form_reseaux(Request $request)
    {
        if($request->ajax()) {
            $parametres = DB::table('parametres')->where('id', 1)->get();
            if ($request['test']==1){
                foreach ($parametres as $key){
                    echo $key->facebook;
                }
            }
            else{
                foreach ($parametres as $key){
                    echo $key->twitter;
                }
            }
        }
        else{
            abort(404);
        }
    }

    public function modifier_reseau(Request $request)
    {
        if($request['testInput'] == 1){
            DB::table('parametres')->where('id','=','1')->update([
                'facebook' => $request['lienInput']
            ]);
        } else {
            DB::table('parametres')->where('id','=','1')->update([
                'twitter' => $request['lienInput']
            ]);
        }

        return back()->with('message', 'Le réseau a bien été modfié.');
    }

    public function commandes()
    {
        return view('adm/adm_commandes');
    }

    public function historique_commandes()
    {
        $products = DB::table('commande')->select('*')->where('statut_prepa','!=','En cours')->orderBy('updated_at','DESC')->paginate(5);
        return view('adm/adm_historique_commande', compact('products'));
    }

    public function informations(Request $request)
    {
        if (!empty($request['last_name']) && !empty($request['first_name']))
        {
            $users = DB::table('users')
                ->where('last_name', '=', $request['last_name'])
                ->where('first_name', '=', $request['first_name'])
                ->paginate(15);
        }
        elseif (!empty($request['last_name']))
        {
            $users = DB::table('users')
                ->where('last_name', '=', $request['last_name'])
                ->paginate(15);
        }

        elseif (!empty($request['first_name']))
        {
            $users = DB::table('users')
                ->where('first_name', '=', $request['first_name'])
                ->paginate(15);
        }
        else
        {
            $users = DB::table('users')->paginate(15);
        }
        return view('adm/adm_informations')->with('users',$users);
    }

    public function droits()
    {
        return view('adm/adm_droits');
    }

    public function expulsions()
    {   
        $users = DB::table('users')->where('ban', '>=', date('Y-m-d H:i:s'))->paginate(15);
        return view('adm/adm_expulsions')->with('users', $users);
    }

    public function expulsion_ajout(Request $request)
    {
        DB::table('users')->where('email','=',$request['mail'])->update([
            'ban' => $request['date']
        ]);

        return back()->with('message', 'L\'utilisateur a bien été expulsé.');
    }

    public function codes()
    {
        $coupons = DB::table('coupon')->orderBy('id','desc')->get();
        return view('adm/adm_codes',compact('coupons'));
    }

    public function articles()
    {
        $categorie = DB::table('categorie')->select('*')->get();
        $pizza = DB::table('pizza')->orderBy('id','desc')->get();
        return view('adm/adm_articles',compact('pizza','categorie'));
    }

    public function menus()
    {
        $menus = DB::table('menu')->select('*')->get();
        $categorie = DB::table('categorie')->select('*')->get();
        $contenu_menu_r = DB::table('contenu_menu')->pluck('id_pizza');
        $contenu_menu = DB::table('contenu_menu')->select('id_menu','id_pizza')->get();
        $pizza = DB::table('pizza')->whereIn('id',$contenu_menu_r)->select('nom','categorie','id')->get();
        return view('adm/adm_menus',compact('pizza','menus','contenu_menu','categorie'));
    }

    public function promotions()
    {
        $pizza = DB::table('pizza')->select('*')->get();
        $categories = DB::table('categorie')->select('*')->get();
        return view('adm/adm_promotions',compact('pizza','categories'));
    }

    public function refresh_article(Request $request)
    {
        $articles = DB::table('pizza')->where('categorie','=',$request['nom'])->select('id','nom')->get();
        echo '<option name="pizza">-- Selectionner --</option>';
        foreach ($articles as $article)
        {
            echo '<option value="'.$article->id.'">'.$article->nom.'</option>';
        }
    }

    public function ajout_engagement(Request $request)
    {
        $imageName = time().'.'.$request->image->extension();
        $imageName1 = 'images/'.$imageName;

        DB::table('engagement')->insert([
            'titre' => $request['titre'],
            'description_courte' => $request['description_courte'],
            'photo' => $imageName1
        ]);

        $request->image->move(public_path('images'), $imageName);
        return back()->with('message', 'Engagement ajouté avec succès !');
    }

    public function enga_afficher_form(Request $request)
    {
        if($request->ajax()){
            $req = DB::table('engagement')->select('*')->where('id','=',$request['id'])->get();
            foreach ($req as $key){
                echo $key->titre."_|".$key->description_courte."_|";
            }
        }
        else{
            abort(404);
        }
    }

    public function modif_engagement(Request $request)
    {
        DB::table('engagement')->where('id','=',$request['engaInput'])->update([
            'titre' => $request['titreM'],
            'description_courte' => $request['description_courteM'], 
        ]);

        if(!empty($request->image)){

            $imageName = time().'.'.$request->image->extension();
            $imageName1 = 'images/'.$imageName;


            DB::table('engagement')->where('id','=',$request['engaInput'])->update([
                'photo' => $imageName1
            ]);

            $request->image->move(public_path('images'), $imageName);
        }

        return back()->with('message', 'L\'engagement a bien été modifié.');
    }

    public function supprimer_engagement(Request $request)
    {
        DB::table('engagement')->where('id', '=', $request['id'])->delete();

        return back()->with('message', 'Engagement supprimé avec succès !');
    }

    public function newsletter(){

        $newsletters = DB::table('newsletter')->select('*')->paginate(10);
        return view('adm/adm_newsletter')->with('newsletters', $newsletters);
    
    }

    public function newsletter_supprimer(Request $request){

        DB::table('newsletter')->where('id','=',$request['id'])->delete();

    }

    public function envoi_mail(Request $request){

        $newsletters = DB::table('newsletter')->select('*')->get();

        $details = [
            'objet' => $request['objet'],
            'contenu' => $request['contenu']
        ];

        foreach($newsletters as $key){
            \Mail::to($key->email)->send(new \App\Mail\NewsMail($details));
        }

        return back()->with('message', 'Le mail a bien été envoyé.');

    }

}
