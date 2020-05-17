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
        $partenaires = DB::table('partenaires')->select('*')->get();
        $avis = DB::table('commentaire')->orderBy('id')->take(3)->get();
        $parametres = DB::table('parametres')->get();
        return view('accueil',compact('pizza','carousel','partenaires', 'avis', 'parametres'));
    }

    public function horaires()
    {
        $horaires = DB::table('horaires')->select('*')->get();
        $fermetures = DB::table('fermeture')->select('*')->get();
        $feriees = DB ::table('feriee')->select('*')->get();
        return view('horaires', compact('horaires', 'fermetures', 'feriees'));
    }

}
