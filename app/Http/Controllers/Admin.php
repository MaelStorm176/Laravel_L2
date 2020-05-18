<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Admin extends Controller
{
    public function index()
    {
        return view('adm/adm_home');
    }

    public function horaires()
    {
        $horaires = DB::table('horaires')->select('*')->get();
        return view('adm/adm_horaires')->with('horaires',$horaires);
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

    public function avis()
    {
        return view('adm/adm_avis');
    }

    public function general()
    {
        $adresse = DB::table('adresse')->where('status', '=', 'principale')->select("*")->get();
        $telephone = DB::table('telephone')->where('id', '=', 1)->select("*")->get();
        DB::table('commentaire')->where('id', '=', 1)->select("*")->get();
        return view('adm/adm_general')->with(compact('adresse','telephone'));
    }

    public function engagements()
    {
        return view('adm/adm_engagements');
    }

    public function secondaire()
    {
        $carousel=DB::table('accueil_carousel')->select('*')->get();
        return view('adm/adm_secondaire')->with('carousel', $carousel);
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

    public function informations()
    {
        return view('adm/adm_informations');
    }

    public function droits()
    {
        return view('adm/adm_droits');
    }

    public function expulsions()
    {
        return view('adm/adm_expulsions');
    }

    public function codes()
    {
        return view('adm/adm_codes');
    }

    public function articles()
    {
        $categorie = DB::table('categorie')->select('*')->get();
        $pizza = DB::table('pizza')->orderBy('id','desc')->get();
        return view('adm/adm_articles',compact('pizza','categorie'));
    }

    public function menus()
    {
        return view('adm/adm_menus');
    }

    public function promotions()
    {
        return view('adm/adm_promotions');
    }

    public function changer_adresse(Request $request)
    {
        DB::table('adresse')->where('status','=', 'principale')->update([
            'rue' => $request['rue'],
            'code_postal' => $request['code_postal'],
            'ville' => $request['ville']
        ]);
        return back()->with('message', 'l\'adresse a bien été changée');
    }

    public function changer_numero(Request $request)
    {
        DB::table('telephone')->where('id','=', 1)->update([
            'numero' => $request['numero']
        ]);
        return back()->with('message', 'le numéro a bien été changée');
    }

    public function identite(Request $request)
    {
        $nom_resto = $request['nomPizzeria'];
        config(['APP_NAME' => $nom_resto]);
        return back();
    }
}
