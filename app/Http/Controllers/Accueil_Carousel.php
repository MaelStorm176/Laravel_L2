<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\File;
class Accueil_Carousel extends Controller
{
    public function afficher_form(Request $request){

        if($request->ajax()) {
            $carousel1 = DB::table('accueil_carousel')->select('*')->where('id','=',$request['id'])->get();
            if ($request['action']==1){
                foreach ($carousel1 as $key){
                    echo $key->titre_carousel."|".$key->titre_couleur."|".$key->texte_carousel."|".$key->texte_couleur."|".$key->fond_couleur."|";
                }
            }
            else{
                return view('formulaire_carousel',compact('carousel1'));
            }
        }
        else{
            abort(404);
        }
    }
    public function modifier(Request $request){
        if(empty($request['image_carousel'])){
            return back()->with('error','Veuillez ajouter une image');
        }

        $validator=Validator::make($request->all(), [
            'image_carousel' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()){
            return back()->with('error','Vous devez mettre une image de type jpeg,png,jpg,gif,svg|max:2048');
        }
        $effacer=DB::table('accueil_carousel')->where('id','=',$request['id_carousel'])->value('image_carousel');
        File::delete($effacer);
        $imageName = time().'.'.$request->image_carousel->extension();
        $imageName1 = 'img/'.$imageName;
        DB::table('accueil_carousel')->select('*')->where('id','=',$request['id_carousel'])->update([
            'image_carousel'=>$imageName1,
            'titre_carousel'=>$request['titre_carousel'],
            'titre_couleur'=>$request['titre_couleur'],
            'texte_carousel'=>$request['texte_carousel'],
            'texte_couleur'=>$request['texte_couleur'],
            'fond_couleur'=>$request['fond_couleur'],
        ]);
        $request->image_carousel->move(public_path('img'), $imageName);

        return back();
    }
    public function ajouter(Request $request){
        $validator=Validator::make($request->all(), [
            'image_carousel' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()){
            return back()->with('error','Vous devez mettre une image de type jpeg,png,jpg,gif,svg|max:2048');
        }

        $imageName = time().'.'.$request['image_carousel']->extension();
        $imageName1 = 'img/'.$imageName;

        DB::table('accueil_carousel')->insert([
            'image_carousel'=>$imageName1,
            'titre_carousel'=>$request['titre_carousel'],
            'titre_couleur'=>$request['titre_couleur'],
            'texte_carousel'=>$request['texte_carousel'],
            'fond_couleur'=>$request['fond_couleur'],
        ]);
        $request->image_carousel->move(public_path('img'), $imageName);
        return back();

    }
    public function supprimer(Request $request){
        $effacer=DB::table('accueil_carousel')->where('id','=',$request['id'])->value('image_carousel');
        File::delete($effacer);
        DB::table('accueil_carousel')->where('id','=',$request['id'])->delete();

        return back();

    }

}
