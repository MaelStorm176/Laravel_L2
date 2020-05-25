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
        $jour = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), date("d"), date("Y")));
        $semaine = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), date("d")-7, date("Y")));
        $mois = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m")-1, date("d"), date("Y")));
        $annee = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), date("d"), date("Y")-1));
        
        $visites = [
            'jour' => DB::table("visites")->where("created_at", ">=", $jour)->count("id"),
            'semaine' => DB::table("visites")->where("created_at", ">=", $semaine)->count("id"),
            'mois' => DB::table("visites")->where("created_at", ">=", $mois)->count("id"),
            'annee' => DB::table("visites")->where("created_at", ">=", $annee)->count("id"),
            'total' => DB::table("visites")->count("id")
        ];

        $users = [
            'jour' => DB::table("users")->where("created_at", ">=", $jour)->count("id"),
            'semaine' => DB::table("users")->where("created_at", ">=", $semaine)->count("id"),
            'mois' => DB::table("users")->where("created_at", ">=", $mois)->count("id"),
            'annee' => DB::table("users")->where("created_at", ">=", $annee)->count("id"),
            'total' => DB::table("users")->count("id")
        ];
        
        $commandes = [
            'jour' => DB::table("commande")->where("created_at", ">=", $jour)->count("id"),
            'semaine' => DB::table("commande")->where("created_at", ">=", $semaine)->count("id"),
            'mois' => DB::table("commande")->where("created_at", ">=", $mois)->count("id"),
            'annee' => DB::table("commande")->where("created_at", ">=", $annee)->count("id"),
            'total' => DB::table("commande")->count("id")
        ];

        $avis = [    
            'jour' => DB::table("commentaire")->where("created_at", ">=", $jour)->count("id"),
            'semaine' => DB::table("commentaire")->where("created_at", ">=", $semaine)->count("id"),
            'mois' => DB::table("commentaire")->where("created_at", ">=", $mois)->count("id"),
            'annee' => DB::table("commentaire")->where("created_at", ">=", $annee)->count("id"),
            'total' => DB::table("commentaire")->count("id")
        ];
        
        return view('adm/adm_home',compact('visites','users','commandes','avis'));
    }

    public function horaires()
    {
        $fermetures = DB::table('fermeture')->select('*')->get();
        $feriees = DB::table('feriee')->select('*')->get();
        $horaires = DB::table('horaires')->select('*')->get();
        return view('adm/adm_horaires',compact('horaires','fermetures', 'feriees'));
    }

    public function creneaux(Request $request)
    {
        $jour = $request['jour'];
        if($request['jour']=='Choisir un jour'){
            return back()->with('error','Vous devez choisir un jour de la semaine');
        }
        $jourv=DB::table('creneaux_config')
            ->select('*')
            ->orderBy('id','asc')
            ->get();
        $global2=DB::table('creneaux_config')->select('jour','livreur_matin')->get();
        $global=DB::table('creneaux_config')->where('jour','=',$jour)->get();

        $table_creneaux = DB::table('creneaux')
            ->select('creneaux','jour','client')
            ->orderBy('jour','asc')
            ->get();
        if (empty($request['jour']) || $request['jour'] != $jourv){
            $creneau_get = DB::table('creneaux')->select('creneaux','livreur_matin','livreur_soir')->where('jour','=','lundi')->get();
            $creneau_livreur = DB::table('creneaux_config')->select('livreur_matin','livreur_soir')->where('jour','=','lundi')->get();

            if($creneau_livreur ==NULL){
                $creneau_livreur_matin = $creneau_livreur[0]->livreur_matin;
                $creneau_livreur_soir = $creneau_livreur[0]->livreur_soir;
                $deb_matin ='Fe';
                $fin_matin ='Fe';
                $deb_soir ='Fe';
                $fin_soir = 'Fe';
                return view('adm.adm_creneaux',compact('creneau_livreur_soir','creneau_livreur_matin','global2','creneau_get','jour','jourv','deb_matin','fin_matin','deb_soir','fin_soir'));

            }

        }
        else{
            if($global->isEmpty()){
                abort(404);
            }
        }

        if (isset($request['jour'])){
            $creneau_get = DB::table('creneaux')->select('creneaux','livreur_matin','livreur_soir')->where('jour','=',$jour)->get();
            $creneau_livreur = DB::table('creneaux_config')->select('livreur_matin','livreur_soir')->where('jour','=',$jour)->get();
            $creneau_livreur_matin = $creneau_livreur[0]->livreur_matin;
            $creneau_livreur_soir = $creneau_livreur[0]->livreur_soir;
            $deb_matin = $global[0]->deb_matin;
            $fin_matin = $global[0]->fin_matin;
            $deb_soir = $global[0]->deb_soir;
            $fin_soir = $global[0]->fin_soir;
            $tmp = substr($deb_matin,-2);

            $deb_matin = substr($deb_matin, -7, 2);//11 H 00
            if ($tmp == '30'){
                $deb_matin1=30;
            }else{
                $deb_matin1=0;
            }
            $tmp = substr($fin_matin,-2);

            $fin_matin = substr($fin_matin, -7, 2);
            if ($tmp == '30'){
                $fin_matin1=30;
            }else{
                $fin_matin1=0;
            }
            $tmp = substr($deb_soir,-2);

            $deb_soir = substr($deb_soir, -7, 2);
            if ($tmp == '30'){
                $deb_soir1=30;
            }else{
                $deb_soir1=0;
            }
            $tmp = substr($fin_soir,-2);

            if ($tmp == '30'){
                $fin_soir1=30;
            }else{
                $fin_soir1=0;
            }
            $fin_soir = substr($fin_soir, -7, 2);

            return view('adm.adm_creneaux',compact('creneau_livreur_soir','creneau_livreur_matin','jourv','jour','creneau_livreur','global2','creneau_get','deb_matin','fin_matin','deb_soir','fin_soir','deb_matin1','fin_matin1','deb_soir1','fin_soir1'));

        }
        else{

            $deb_matin ='Fe';
            $fin_matin ='Fe';
            $deb_soir ='Fe';
            $fin_soir = 'Fe';
            return view('adm.adm_creneaux',compact('creneau_livreur_soir','creneau_livreur_matin','global2','jourv','creneau_get','jour','deb_matin','fin_matin','deb_soir','fin_soir','table_creneaux'));
        }
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
        if(empty($request->logo) && empty($request->baniere)){
            return back()->with('erreur', 'Veuillez selectionner au moins une image');
        }

        $path = base_path('config/images.php');

        if (file_exists($path) && !empty($request->baniere)) {

            $banName = time().'.'. $request->baniere->extension();
            $banName1 = 'images/'.$banName;
            
            file_put_contents($path, str_replace(
                "'baniere' => '" . config('images.baniere') . "'", "'baniere' => '" . $banName1 . "'", file_get_contents($path)
            ));

            $request->baniere->move(public_path('images'), $banName);

        }

        if(file_exists($path) && !empty($request->logo)){

            $logoName = time()+1 .'.'. $request->logo->extension();
            $logoName1 = 'images/'.$logoName;

            file_put_contents($path, str_replace(
                "'logo' => '" . config('images.logo') . "'", "'logo' => '" . $logoName1 . "'", file_get_contents($path)
            ));

            $request->logo->move(public_path('images'), $logoName);
        }

        return back()->with('message', 'Les images ont bien été enregistré.');
    }

    public function adresse(Request $request)
    {
        DB::table('parametres')->where('id','=','1')->update([
            'adresse' => $request['adresse'],
            'codePostal' => $request['cp'],
            'ville' => $request['ville'],
            'iframe' => $request['iframe']

        ]);

        return back()->with('message', 'L\'adresse a bien été modifié.');
    }

    public function points(Request $request){
        DB::table('parametres')->where('id','=','1')->update([
            'ptsEquivalent' => $request['equivalent'],
            'ptsGain' => $request['gain'],
            'ptsNbComm' => $request['nbComm'],
            'ptsMinTotal' => $request['minTotal']
        ]);

        return back()->with('message', 'Les parametres des points de fidelité ont bien été modifiés.');
    }

    public function gmail(Request $request)
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "MAIL_USERNAME=" . env('MAIL_USERNAME'), "MAIL_USERNAME=" . $request['mail'], file_get_contents($path)
            ));

            file_put_contents($path, str_replace(
                'MAIL_PASSWORD="' . env('MAIL_PASSWORD') . '"', 'MAIL_PASSWORD="' . $request['mdp'] . '"', file_get_contents($path)
            ));

            file_put_contents($path, str_replace(
                "MAIL_FROM_ADDRESS=" . env('MAIL_FROM_ADDRESS'), "MAIL_FROM_ADDRESS=" . $request['mail'], file_get_contents($path)
            ));
        }

        return back()->with('message', 'Le compte a bien été enregistré.');
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
        if ($request->ajax()) {
            DB::table('partenaires')->where('id', '=', $request['id'])->delete();
        }
        else
        {
            abort(404);
        }
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
        if (!empty($request['last_name']) && !empty($request['first_name']) && !empty($request['pseudo']))
        {
            $users = DB::table('users')
                ->where('last_name', '=', $request['last_name'])
                ->where('first_name', '=', $request['first_name'])
                ->where('username', '=', $request['pseudo'])
                ->paginate(15);
        }
        else if(!empty($request['last_name']) && empty($request['first_name']) && empty($request['pseudo'])){
            $users = DB::table('users')
                ->where('last_name', '=', $request['last_name'])
                ->paginate(15);
        }
        else if(empty($request['last_name']) && !empty($request['first_name']) && empty($request['pseudo'])){
            $users = DB::table('users')
                ->where('first_name', '=', $request['first_name'])
                ->paginate(15);

        } elseif(empty($request['last_name']) && empty($request['first_name']) && !empty($request['pseudo'])){
            $users = DB::table('users')
                ->where('username', '=', $request['pseudo'])
                ->paginate(15);
        }
        elseif(!empty($request['last_name']) && !empty($request['first_name']) && empty($request['pseudo'])){
            $users = DB::table('users')
                ->where('last_name', '=', $request['last_name'])
                ->where('first_name', '=', $request['first_name'])
                ->paginate(15);

        }
        elseif(empty($request['last_name']) && !empty($request['first_name']) && !empty($request['pseudo'])){
            $users = DB::table('users')
                ->where('first_name', '=', $request['first_name'])
                ->where('username', '=', $request['pseudo'])
                ->paginate(15);

        }
        elseif(!empty($request['last_name']) && empty($request['first_name']) && !empty($request['pseudo'])){
            $users = DB::table('users')
                ->where('last_name', '=', $request['last_name'])
                ->where('username', '=', $request['pseudo'])
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
        $droits = DB::table('droits')->select('*')->get();
        return view('adm/adm_droits')->with('droits', $droits);
    }

    public function supprimer_droits(Request $request){

        if ($request->ajax()) {
            DB::table('droits')->select('*')->where('id', '=', $request['id'])->delete();
        }
        else
        {
            abort(404);
        }

    }

    public function droits_ajouter(Request $request){
        
        $user = DB::table('users')->select('*')->where('email', '=', $request['mail'])->get();
        
        if($user->isEmpty()){
            return back()->with('erreur', 'L\'utilisateur n\'existe pas.');
        }

        DB::table('droits')->updateOrInsert([
            'user_id' => $user[0]->id
        ]);

        DB::table('users')->where('email', '=', $request['mail'])->update([
            'role' => 'admin'
        ]);

        return back()->with('message', 'L\'utilisateur a été ajouté avec succes.');
    }

    public function droits_modifier(Request $request){

        if($request->ajax()){

            $test = DB::table('droits')->where('id', $request['id'])->get();
            
            if($request['categorie'] == 'moderation'){
                if($test[0]->moderation){
                    DB::table('droits')->where('id', $request['id'])->update([
                        'moderation' => 0
                    ]);
                } else {
                    DB::table('droits')->where('id', $request['id'])->update([
                        'moderation' => 1
                    ]);
                }
            } elseif($request['categorie'] == 'restauration'){
                if($test[0]->restauration){
                    DB::table('droits')->where('id', $request['id'])->update([
                        'restauration' => 0
                    ]);
                } else {
                    DB::table('droits')->where('id', $request['id'])->update([
                        'restauration' => 1
                    ]);
                }
            } elseif($request['categorie'] == 'parametre'){
                if($test[0]->parametre){
                    DB::table('droits')->where('id', $request['id'])->update([
                        'parametre' => 0
                    ]);
                } else {
                    DB::table('droits')->where('id', $request['id'])->update([
                        'parametre' => 1
                    ]);
                }
            } elseif($request['categorie'] == 'upgrade'){
                if($test[0]->upgrade){
                    DB::table('droits')->where('id', $request['id'])->update([
                        'upgrade' => 0
                    ]);
                } else {
                    DB::table('droits')->where('id', $request['id'])->update([
                        'upgrade' => 1
                    ]);
                }
            } elseif($request['categorie'] == 'newsletter'){
                if($test[0]->newsletter){
                    DB::table('droits')->where('id', $request['id'])->update([
                        'newsletter' => 0
                    ]);
                } else {
                    DB::table('droits')->where('id', $request['id'])->update([
                        'newsletter' => 1
                    ]);
                }
            }

        } else {
            abort(404);
        }

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
    public function expulsion_supprimer(Request $request)
    {
        DB::table('users')->where('id','=',$request['id'])->update([
            'ban' => NULL
        ]);

        return back()->with('message', 'L\'expulsion a été retiré');
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

    public static function afficher_droits(){

        $droits = DB::table('droits')->where('user_id', Auth::user()->id)->get();

        return $droits;
    }

}
