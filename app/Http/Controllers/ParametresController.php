<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParametresController extends Controller
{

    public function update()
    {
        if (isset($_GET['bouton'])) {
            DB::table("users")->update([
                'username' => $_GET["username"],
                'first_name' => $_GET["first_name"],
                'last_name' => $_GET["last_name"]
            ]);
        }
        return back();
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
