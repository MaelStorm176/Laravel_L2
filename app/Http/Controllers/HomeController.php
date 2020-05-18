<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $pizza = DB::table('pizza')->select('*')->where('statut','=','Disponible')->get();
        $carousel=DB::table('accueil_carousel')->select('*')->get();
        $commentaires = DB::table("commentaire")
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->select('*')->get();
        $nb_user = DB::table("users")->count("id");
        $nb_commande = DB::table("commande")->count("id");
        $nb_avis = DB::table("commentaire")->count("id");
        $partenaires = DB::table('partenaires')->select('*')->get();
        $parametres = DB::table('parametres')->get();
        return view('accueil')->with(compact('pizza', 'carousel', 'adresse', 'telephone', 'commentaires', 'nb_user', 'parametres', 'partenaires', 'nb_commande', 'nb_avis'));
    }

    public function horaires()
    {
        $horaires = DB::table('horaires')->select('*')->get();
        $fermetures = DB::table('fermeture')->select('*')->get();
        $feriees = DB ::table('feriee')->select('*')->get();
        return view('horaires', compact('horaires', 'fermetures', 'feriees'));
    }

}
