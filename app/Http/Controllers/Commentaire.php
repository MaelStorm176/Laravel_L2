<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Commentaire extends Controller
{
    public function index(){
        $commentaires = $this->afficher();
    	return view('avis',compact('commentaires','pseudo'));
    }

    public function ajout(Request $request){
        if($request->ajax()){
            $user = auth()->user();
            $validate_data = Validator::make($request->all(), [
                'email' => 'required|email',
                'comm' => 'sometimes|required',
                'value' => 'required|between:0,5'
            ]);

            if($validate_data->fails() || $request['email'] != $user->email) {
                echo "Il y a une erreur avec votre E-mail ou votre commentaire";
            }
            else{   //il faut checker si l'adresse mail rentrée  est la meme que celle en base
                DB::table("Commentaire")->insert([
                    'email' => $request["email"],
                    'commentaire' => $request["comm"],
                    'note' => $request["value"],
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
        else {
            abort('404');
        }
    }
    public function clear_db()
    {
    	Db::table('Commentaire')->delete();
    	return back()->with('message','Base de commentaire vidée');
    }

    public function afficher(){ //affichage du dernier commentaire
    	$top_comm = DB::table('Commentaire')->orderBy('id','DESC')->select('commentaire','note')->get();
    	return $top_comm;
    }

}
