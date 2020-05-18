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
        $adresse = DB::table('adresse')->where('status', '=', 'principale')->select("*")->get();
        $telephone = DB::table('telephone')->where('id', '=', 1)->select("*")->get();
        return view('accueil')->with('pizza',$pizza)->with('carousel',$carousel)->with('adresse', $adresse)->with('telephone', $telephone);
    }

    public function horaires()
    {
        $horaires = DB::table('horaires')->select('*')->get();
        return view('horaires')->with('horaires',$horaires);
    }

}
