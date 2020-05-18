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
        $commentaires = DB::table("commentaire")
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->select('*')->get();
        $nb_user = DB::table("users")->count("id");
        return view('accueil')->with(compact('pizza', 'carousel', 'adresse', 'telephone', 'commentaires', 'nb_user'));
    }

    public function horaires()
    {
        $horaires = DB::table('horaires')->select('*')->get();
        return view('horaires')->with('horaires',$horaires);
    }

}
