<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParametresController extends Controller
{

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
