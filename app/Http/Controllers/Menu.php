<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Menu extends Controller
{
    public function upload(Request $request)
    {
        //Création d'un menu
        $id_menu = DB::table('menu')->insertGetId([
            'nom'           => $request['nom_m'],
            'prix'          => $request['prix_m'],
            'promo'     => $request['prix_m'],
            'description'   => $request['description_m']
        ]);

        //Pour chaque check-box coché, on ajoute l'id de l'article correspondant
        foreach ($request['article'] as $item) {
            DB::table('contenu_menu')->insert([
                'id_menu' => $id_menu,
                'id_pizza' => $item
            ]);
        }

        return back()->with('message','Votre menu a été créé');
    }

    public function modifier(Request $request)
    {
        DB::table('menu')->where('id','=',$request['id_menu'])->update([
            'nom'           => $request['nom_m'],
            'prix'          => $request['prix_m'],
            'promo'         => $request['prix_m'],
            'description'   => $request['description_m']
        ]);


        DB::table('contenu_menu')->where('id_menu','=',$request['id_menu'])->delete();

        //Pour chaque check-box coché, on ajoute l'id de l'article correspondant
        foreach ($request['article'] as $item) {
            DB::table('contenu_menu')->where('id_menu','=',$request['id_menu'])->insert([
                'id_menu' => $request['id_menu'],
                'id_pizza' => $item
            ]);
        }

        return back()->with('message','Votre menu a été modifié');
    }

    public function afficher_form(Request $request)
    {
        if($request->ajax()) {
            $menu = DB::table('menu')->where('id','=',$request['id'])->select('*')->get();
            $contenu_menu = DB::table('contenu_menu')->where('id_menu','=',$request['id'])->pluck('id_pizza');
            $pizza = DB::table('pizza')->whereIn('id',$contenu_menu)->select('id','categorie')->get();
            foreach ($menu as $key){
                echo $key->nom."_|".$key->description."_|".$key->promo."_|";
            }
            foreach ($pizza as $key){
                echo $key->id."_|".$key->categorie."_|";
            }
        }
        else
        {
            abort(404);
        }

    }

    public function afficher_cat(Request $request)
    {
        $pizza = DB::table('pizza')->select('id','nom')->where('categorie','=',$request['categorie'])->get();
        foreach ($pizza as $key) {
            echo
            '
            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                <input type="checkbox" name="article[]" class="custom-control-input" id="check_box_'.$key->id.'" value="'.$key->id.'">
                <label class="custom-control-label" for="check_box_'.$key->id.'">'.$key->nom.'</label>
            </div>
            ';
        }
    }

    public function afficher_menu()
    {
        $menu = DB::table('menu')->orderBy('id','desc')->get();
        $contenu_menu = DB::table('contenu_menu')->get();

        return array($menu,$contenu_menu);
    }


    public function detail(Request $request)
    {
        $menu = DB::table("menu")->select('*')->where('nom','=',$request['menu_nom'])->get();
        $menu_id  = $menu[0]->id;
        $contenu_menu = DB::table('contenu_menu')->where('id_menu','=',$menu_id)->pluck('id_pizza');
        $pizza = DB::table('pizza')->whereIn('id',$contenu_menu)->select('nom','categorie')->get();

        return view('menu_detail',compact('menu','pizza'));
    }

    public function supprimer(Request $request)
    {
        if($request->ajax()) {
            $menu = DB::table('menu')->where('id','=',$request['id'])->delete();
            $contenu_menu = DB::table('contenu_menu')->where('id_menu','=',$request['id'])->delete();
        }
        else
        {
            abort(404);
        }
    }

    //Permet d'appliquer une promotion à un produit
    public function promotion(Request $request)
    {
        $validate_data = Validator::make($request->all(), [
            'promotion' => 'required|integer|between:0,100'
        ]);
        if($validate_data->fails()){
            return back()->with('message',"Il y a une erreur avec la modification de votre menu.");
        }
        $prix = DB::table("menu")->where('id','=',$request['id'])->value('prix');
        $prix_promo = $prix*(1-$request['promotion']/100);

        DB::table("menu")->where('id','=',$request['id'])->update(['promo' => $prix_promo]);
        return back();
    }

}
