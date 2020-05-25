<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {   
        $testVisites = DB::table('visites')
        ->where('ip', '=', $_SERVER['REMOTE_ADDR'])
        ->where('created_at', '>=', date('Y-m-d H:i:s', mktime(0,0,0,date('m'), date('d'), date('Y'))))
        ->count('id');

        if($testVisites == 0){
            DB::table('visites')->insert([
                'ip' => $_SERVER['REMOTE_ADDR'],
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        $pizza = DB::table('pizza')->select('*')->where('statut','=','Disponible')->get();
        $carousel=DB::table('accueil_carousel')->select('*')->get();
        $commentaires = DB::table("commentaire")
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->select('*')->get();
        $partenaires = DB::table('partenaires')->select('*')->get();
        $parametres = DB::table('parametres')->get();
        return view('accueil')->with(compact('pizza', 'carousel', 'adresse', 'telephone', 'commentaires', 'parametres', 'partenaires'));
    }

    public function horaires()
    {
        $horaires = DB::table('horaires')->select('*')->get();
        $fermetures = DB::table('fermeture')->select('*')->get();
        $feriees = DB ::table('feriee')->select('*')->get();
        return view('horaires', compact('horaires', 'fermetures', 'feriees'));
    }

    public function newsletter_ajout(Request $request){

        DB::table('newsletter')->updateOrInsert([
            'email' => $request['email'],
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return back()->with('message', 'Votre adresse mail a bien été enregistré.');
    }
}
