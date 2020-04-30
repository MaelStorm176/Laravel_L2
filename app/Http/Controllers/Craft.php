<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\File;
class Craft extends Controller
{

    public function supprimer(Request $request){
        if($request->ajax()) {
            $image = DB::table('ingredient')->select('image')->where('id','=',$request['id'])->value('image');
            File::delete($image);
            DB::table('ingredient')->where('id','=',$request['id'])->delete();
            return redirect()->route('make-migration');

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
        return view('pizza.pizza_craft', compact('ingredients'));
    }


    public function ajouter_ingredient(Request $request){
        $request->validate([
            'image_i' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image_i->extension();
        $imageName1 = 'image_i/'.$imageName;
        $table=DB::table("ingredient")->select('*')->get();
        foreach ($table as $key){

            if ($key->nom_i == $request['nom_i']){
                return back()->with('error',"Veuillez ne pas entrer le même nom qu'un autre ingrédient ");
            }
        }
        DB::table("ingredient")->insert([
            'nom_i' => $request["nom_i"],
            'image' => $imageName1,
            'prix_i' => $request["prix_i"]
        ]);
        $request->image_i->move(public_path('image_i'), $imageName);

        return redirect()->route('make-migration')
            ->with('success','You have successfully upload image.');

    }
    public function modifier(Request $request){
            $imageName = time().'.'.$request->image_i->extension();
            $imageName1 = 'image_i/'.$imageName;
            $table=DB::table("ingredient")->select('*')->get();

            foreach ($table as $key){
                if ($key->id == $request['id_ingredient']){
                    DB::table('ingredient')->where('id','=',$request['id_ingredient'])->update([
                        'image' => $imageName1,
                        'nom_i' => $request["nom_i"],
                        'prix_i' => $request["prix_i"]
                    ]);
                    $request->image_i->move(public_path('image_i'), $imageName);
                    return back();
                }
                else{
                    return back()->with('error',"Veuillez ne pas entrer le même nom qu'un autre ingrédient ");
                }
            }
        $request->image_i->move(public_path('image_i'), $imageName);
        return redirect()->route('make-migration')->with('error','Il faut remplir tous les champs');
    }

    public function ajouter(Request $request){

        $table=DB::table("ingredient")->select('*')->get();
        $pizza_id=DB::table("craft_pizza")->select('*')->get();
        $var1=0;
        foreach ($pizza_id as $item) {
            $var1=$item->id;
        }

        $tmp=0;
        foreach ($table as $key){
            $tmp+=$request['prix_recup_'.$key->id];
            if (!empty($request['ingredient_'.$key->id])){
            DB::table('craft_pizza')->updateOrInsert([
                'id'=>$var1+1],[
                $key->nom_i=>$request['ingredient_'.$key->id],
                'user_id'=>Auth::user()->id,
                'prix_total_i'=>$tmp
            ]);
            }
            }
        return back();


        }

}
