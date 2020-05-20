<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CodeController extends Controller
{
    public function upload(Request $request)
    {
        $rand = (Str::random(4));
        for($i=0; $i<3; $i++) {
            $rand = $rand . "-";
            $rand = $rand.(Str::random(4));
        }

        $validate_data = Validator::make($request->all(), [
            'remise' => 'required|integer|between:0,100',
            'date_limite' => 'required',
        ]);

        if($validate_data->fails()){
            return back()->with('message',"Il y a une erreur avec la création de votre code.");
        }

        DB::table("coupon")->insert([
            'code' => $rand,
            'remise' => $request["remise"],
            'date_limite' => $request["date_limite"],
            'valide' => 1
        ]);

        return back()->with('message','Votre code a été enregistré !');
    }

    public function supprimer(Request $request)
    {
        if($request->ajax()) {
            if (isset($request['id'])) {
                DB::table("coupon")->where('id', '=', $request['id'])->delete();
            }
        }
        else
        {
            abort(404);
        }
    }
}
