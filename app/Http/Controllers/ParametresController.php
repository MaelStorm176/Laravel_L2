<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParametresController extends Controller
{
    public function index(Request $request)
    {
        $user = DB::table('users')->where('id', auth::user()->id)->get();
        return view('parametres')->with('user', $user[0]);
    }

    public function modif_adresse(Request $request)
    {
        $user = DB::table('users')->where('id', auth::user()->id)->update([ 
            'adresse' => $request['adresse']
        ]);

        
        return back()->with('message', 'L\'adresse a bien été modifié');
    }

    public function update(Request $request)
    {
        if (isset($request['bouton'])) {
            DB::table("users")->where('id','=',Auth::user()->id)->update([
                'username' => $request["username"],
                'first_name' => $request["first_name"],
                'last_name' => $request["last_name"]
            ]);
        }
        return back()->with('message','Vos informations ont bien été enregistré');
    }

    public function verify()
    {
        return redirect('email/verify');
    }

    protected function verif_email()
    {
        DB::table("users")->where('id', '=', auth::user()->id)->update([
            'role' => 'verifie'
        ]);

        return view('/parametres');
    }

}
