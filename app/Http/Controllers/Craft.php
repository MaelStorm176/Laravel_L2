<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Type\Integer;

class Craft extends Controller
{

    public function supprimer(Request $request){
        if($request->ajax()) {
            DB::table('ingredient')->where('id','=',$request['id'])->delete();

        }


    }
    public function afficher_form(Request $request){
        if($request->ajax()) {
            $select=DB::table('ingredient')->select('*')->where('id','=',$request['id'])->get();
            foreach ($select as $key){
                echo $key->nom_i."|".$key->prix_i."|";
            }

        }

    }


    public function index(){
        return view('/craft');
    }
    public static function afficher(){

        $ingredients=DB::table('ingredient')->select('*')->get();
        return view('craft', compact('ingredients'));
    }


    public function ajouter_ingredient(Request $request){
        $request->validate([
            'image_i' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image_i->extension();
        $imageName1 = '/image_i/'.$imageName;

        DB::table("ingredient")->insert([
            'nom_i' => $request["nom_i"],
            'image' => $imageName1,
            'prix_i' => $request["prix_i"]
        ]);
        $request->image_i->move(public_path('image_i'), $imageName);

        return back()
            ->with('success','You have successfully upload image.');

    }
    public function modifier(Request $request){
            $imageName = time().'.'.$request->image_i->extension();
            $imageName1 = '/image_i/'.$imageName;
            /*if (!empty($request['image_i'])&& !empty($request['nom_i']) && !empty($request['prix_i'])){*/
            DB::table('ingredient')->where('id','=',$request['edit'])->update([
                'nom_i' => $request["nom_i"],
                'image' => $imageName1,
                'prix_i' => $request["prix_i"]
            ]);

           /* }*/

        /*else{*/
        $request->image_i->move(public_path('image_i'), $imageName);
            return back()->with('error','Il faut remplir tous les champs');
        //}
        //echo $request['edit'];
       // return back();
    }

    public function ajouter(Request $request){

        $table=DB::table("ingredient")->select('*')->get();
        $var=0;
        $pizza_id=DB::table("craft_pizza")->select('*')->get();
        $var1=0;
        foreach ($pizza_id as $item) {
            $var1=$item->id;

        }
        foreach ($table as $key){
            $var++;
            if (!empty($request['ingredient_'.$var])){
            DB::table('craft_pizza')->updateOrInsert([
                'id'=>$var1+1],[
                $key->nom_i=>$request['ingredient_'.$var],
                'user_id'=>Auth::user()->id
            ]);
            }
            }
        return back();


        }






}
