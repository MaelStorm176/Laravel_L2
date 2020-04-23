<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class Pizza extends Controller
{

    public function index()
    {
        return view('pizza.pizza_index');
    }

    //Permet d'afficher le carousel des pizzas n'importe où
    public static function afficher()
    {
        $pizza = DB::table('pizza')->select('*')->get();
        return view('pizza.pizza_carousel')->with('pizza',$pizza);
    }

    //Permet de pré-remplir le formulaire de modification de pizza
    public function afficher_form(Request $request){
        if($request->ajax()){
            $req = DB::table('pizza')->select('*')->where('id','=',$request['id'])->get();
            foreach ($req as $key){
                echo $key->photo."_|".$key->nom."_|".$key->categorie."_|".$key->description_courte."_|".$key->description_longue."_|".$key->prix."_|".$key->statut;
            }
        }
    }

    //Upload d'une pizza
    public function upload(Request $request)
    {
        $validate_data = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nom_p' => 'required',
            'description_p'=> 'required',
            'prix_p' => 'required|integer|between:0,100'
        ]);

        if($validate_data->fails()){
            return back()->with('message',"Il y a une erreur avec la création de votre pizza.");
        }

        $imageName = time().'.'.$request->image->extension();
        $imageName1 = 'images/'.$imageName;

        DB::table("pizza")->insert([
            'nom' => $request["nom_p"],
            'photo' => $imageName1,
            'description_courte' => $request["description_courte"],
            'description_longue' => $request["description_longue"],
            'statut' => $request["statut_p"],
            'prix' => $request["prix_p"],
            'promo' => $request["prix_p"]
        ]);
        $request->image->move(public_path('images'), $imageName);

        return back()->with('message','Votre pizza a été mise en ligne !');
    }

    //Selectionne toutes les pizzas afin de les afficher
    public function all(){
        $pizza = DB::table('pizza')->select('*')->get();
        return view('pizza.pizza_carte')->with('pizza',$pizza); //je retourne la vue pizza_all avec une variable nommée $pizza
    }

    //Modifie une pizza
    public function modifier(Request $request)
    {
        $validate_data = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nom_p' => 'required',
            'prix_p' => 'required|integer|between:0,100'
        ]);

        if($validate_data->fails()){
            return back()->with('message',"Il y a une erreur avec la modification de votre pizza.");
        }

        $imageName = time().'.'.$request->image->extension();
        $imageName1 = 'images/'.$imageName;

        DB::table("pizza")->where('id','=',$request['id_pizza'])->update([
            'nom' => $request["nom_p"],
            'photo' => $imageName1,
            'description_courte' => $request["description_courte"],
            'description_longue' => $request["description_longue"],
            'statut' => $request["statut_p"],
            'prix' => $request["prix_p"]
        ]);
        $request->image->move(public_path('images'), $imageName);

        return back()->with('message','Votre pizza a été modifié !');
    }

    //Supprimer une pizza
    public function supprimer(Request $request)
    {
        $requete = DB::table("pizza")->select('*')->where('id','=',$request['id']);
        $pizza =  $requete->get();
        foreach ($pizza as $key){
            File::delete($key->photo); //Supprime la photo du dossier publique
        }
        $requete->delete();
    }

    //Afficher le détail de la pizza selectionnée
    public function detail($pizza_nom)
    {
        $pizza = DB::table("pizza")->select('*')->where('nom','=',$pizza_nom)->get();
        return view('pizza.pizza_detail')->with('pizza',$pizza);
    }

    //Permet d'appliquer une promotion à un produit
    public function promotion(Request $request)
    {
        $validate_data = Validator::make($request->all(), [
            'promotion' => 'required|integer|between:0,100'
        ]);
        if($validate_data->fails()){
            return back()->with('message',"Il y a une erreur avec la modification de votre pizza.");
        }
        $prix = DB::table("pizza")->select('prix')->where('id','=',$request['id'])->get();
        foreach ($prix as $key){
            $prix_promo = $key->prix*(1-$request['promotion']/100);
        }
        DB::table("pizza")->where('id','=',$request['id'])->update(['promo' => $prix_promo]);
        return back();
    }
}
