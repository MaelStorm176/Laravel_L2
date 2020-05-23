<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class Pizza extends Menu
{

    //Permet de pré-remplir le formulaire de modification de pizza
    public function afficher_form(Request $request){
        if($request->ajax()){
            $req = DB::table('pizza')->select('*')->where('id','=',$request['id'])->get();
            foreach ($req as $key){
                echo $key->photo."_|".$key->nom."_|".$key->categorie."_|".$key->description_courte."_|".$key->description_longue."_|".$key->prix."_|".$key->statut."_|";
            }

            $nutrition = DB::table('nutrition')
                ->join('pizza','pizza.nutrition','=','nutrition.id')
                ->where('pizza.id','=',$request['id'])
                ->where('nutrition.id','=',$key->nutrition)
                ->select('nutrition.*')
                ->get();

            foreach ($nutrition as $key2)
            {
                echo $key2->Sodium."_|".$key2->Fibres."_|".$key2->Dont_satures."_|".$key2->Lipides."_|".$key2->Dont_sucres."_|".$key2->Glucides."_|".$key2->Proteines."_|".$key2->Energies;
            }
        }
        else{
            abort(404);
        }
    }

    //Upload d'une pizza
    public function upload(Request $request)
    {
        $validate_data = Validator::make($request->all(), [
            'image'             =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nom_p'             =>  'required',
            'statut_p'          =>  'required',
            'prix_p'            =>  'nullable|integer|between:0,100',
            'sodium'            =>  'nullable|integer|between:0,10000',
            'fibres'            =>  'nullable|integer|between:0,10000',
            'dont_satures'      =>  'nullable|integer|between:0,10000',
            'lipides'           =>  'nullable|integer|between:0,10000',
            'dont_sucres'       =>  'nullable|integer|between:0,10000',
            'glucides'          =>  'nullable|integer|between:0,10000',
            'proteines'         =>  'nullable|integer|between:0,10000',
            'energies'          =>  'nullable|integer|between:0,10000'
        ]);

        if($validate_data->fails()){
            return back()->with('erreur',"Il y a une erreur avec la création de votre article.");
        }

        /* INSERTION NUTRITION */
        DB::table('nutrition')
            ->insert([
            'Sodium'       => $request["sodium"],
            'Fibres'       => $request["fibres"],
            'Dont_satures' => $request["dont_satures"],
            'Lipides'      => $request["lipides"],
            'Dont_sucres'  => $request["dont_sucres"],
            'Glucides'     => $request["glucides"],
            'Proteines'    => $request["proteines"],
            'Energies'     => $request["energies"]
        ]);

        $id_nutrition = DB::table('nutrition')->latest('id')->value('id');


        /* INSERTION TABLE PIZZA */
        $imageName = time().'.'.$request->image->extension();
        $imageName1 = 'images/'.$imageName;

        DB::table("pizza")->insert([
            'nom'                => $request["nom_p"],
            'photo'              => $imageName1,
            'statut'             => $request["statut_p"],
            'categorie'          => $request["categorie"],
            'description_courte' => $request["description_courte"],
            'description_longue' => $request["description_longue"],
            'nutrition'          => $id_nutrition,
            'prix'               => $request["prix_p"],
            'promo'              => $request["prix_p"]
        ]);
        $request->image->move(public_path('images'), $imageName);

        return back()->with('message','Votre '.$request['categorie'].' a été mise en ligne !');
    }

    //Selectionne toutes les pizzas afin de les afficher
    public function all(){
        list($menu,$contenu_menu) = $this->afficher_menu();
        $categorie = DB::table('categorie')->select('*')->get();
        $pizza = DB::table('pizza')->orderBy('id','desc')->get();
        return view('pizza.pizza_carte',compact('pizza','categorie','menu','contenu_menu')); //je retourne la vue pizza_all avec une variable nommée $pizza
    }

    //Modifie une pizza
    public function modifier(Request $request)
    {
        $validate_data = Validator::make($request->all(), [
            'image'             =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nom_p'             =>  'required',
            'statut_p'          =>  'required',
            'prix_p'            =>  'nullable|integer|between:0,100',
            'sodium'            =>  'nullable|integer|between:0,10000',
            'fibres'            =>  'nullable|integer|between:0,10000',
            'dont_satures'      =>  'nullable|integer|between:0,10000',
            'lipides'           =>  'nullable|integer|between:0,10000',
            'dont_sucres'       =>  'nullable|integer|between:0,10000',
            'glucides'          =>  'nullable|integer|between:0,10000',
            'proteines'         =>  'nullable|integer|between:0,10000',
            'energies'          =>  'nullable|integer|between:0,10000'
        ]);

        if($validate_data->fails()){
            return back()->with('erreur',"Il y a une erreur avec la modification de votre article.");
        }

        $id_nutrition = DB::table('pizza')->where('id','=',$request['id_pizza'])->select('nutrition')->value('nutrition');
        DB::table('nutrition')
            ->where('id','=',$id_nutrition)
            ->update([
                'Sodium'       => $request["sodium"],
                'Fibres'       => $request["fibres"],
                'Dont_satures' => $request["dont_satures"],
                'Lipides'      => $request["lipides"],
                'Dont_sucres'  => $request["dont_sucres"],
                'Glucides'     => $request["glucides"],
                'Proteines'    => $request["proteines"],
                'Energies'     => $request["energies"]
            ]);


        $imageName = time().'.'.$request->image->extension();
        $imageName1 = 'images/'.$imageName;

        DB::table("pizza")->where('id','=',$request['id_pizza'])->update([
            'nom'                => $request["nom_p"],
            'photo'              => $imageName1,
            'categorie'          => $request["categorie"],
            'description_courte' => $request["description_courte"],
            'description_longue' => $request["description_longue"],
            'statut'             => $request["statut_p"],
            'prix'               => $request["prix_p"],
            'promo'              => $request["prix_p"]
        ]);
        $request->image->move(public_path('images'), $imageName);

        return back()->with('message','Votre '.$request['categorie'].' a été modifié !');
    }

    //Supprimer une pizza
    public function supprimer(Request $request)
    {
        if ($request->ajax())
        {
            $requete = DB::table("pizza")->select('*')->where('id','=',$request['id']);
            $pizza =  $requete->get();
            foreach ($pizza as $key){
                File::delete($key->photo); //Supprime la photo du dossier publique
            }
            DB::table("nutrition")->select('*')->where('id','=',$key->nutrition)->delete();
            $requete->delete();
        }
        else
        {
            abort(404);
        }
    }

    //Afficher le détail de la pizza selectionnée
    public function detail($pizza_nom)
    {
        $pizza = DB::table("pizza")->select('*')->where('nom','=',$pizza_nom)->get();
        if($pizza->isEmpty())
        {
            abort(404);
        }
        else {
            if ($pizza[0]->statut == 'Indisponible') {
                abort(404);
            } else {
                return view('pizza.pizza_detail', compact('pizza'));
            }
        }
    }

    public function nutrition(Request $request)
    {
        if ($request->ajax()){
            $nutrition = DB::table('nutrition')->where('id', '=', $request['id'])->select('*')->get();
            foreach ($nutrition as $key2) {
                echo $key2->Sodium . "_|" . $key2->Fibres . "_|" . $key2->Dont_satures . "_|" . $key2->Lipides . "_|" . $key2->Dont_sucres . "_|" . $key2->Glucides . "_|" . $key2->Proteines . "_|" . $key2->Energies;
            }
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
            return back()->with('erreur',"Il y a une erreur avec la modification de votre article.");
        }
        $prix = DB::table("pizza")->select('prix')->where('id','=',$request['id'])->get();
        $prix_promo = 0;
        foreach ($prix as $key){
            $prix_promo = $key->prix*(1-$request['promotion']/100);
        }
        DB::table("pizza")->where('id','=',$request['id'])->update(['promo' => $prix_promo]);
        return back();
    }

    public function categorie_upload(Request $request)
    {
        $validate_data = Validator::make($request->all(), [
            'nom' => 'required|string'
        ]);
        if($validate_data->fails()){
            return back()->with('erreur',"Il y a une erreur avec l'ajout de votre catégorie.");
        }
        DB::table('categorie')->updateOrInsert(['nom' => $request['nom']]);
        return back()->with('message','Votre catégorie '.$request['nom'].' a été ajouté');
    }

    public function categorie_supprimer(Request $request)
    {
        if (isset($request['choix']))
        {
            if ($request['choix'] == 'oui')
            {
                $pizza = DB::table('pizza')
                    ->join('categorie','pizza.categorie','=','categorie.nom')
                    ->where('categorie.id','=',$request['id_cate'])
                    ->pluck('pizza.id');
                DB::table('contenu_menu')->where('id_pizza','=',$pizza)->delete();
                DB::table('pizza')
                    ->join('categorie','pizza.categorie','=','categorie.nom')
                    ->where('categorie.id','=',$request['id_cate'])
                    ->delete();
                DB::table('categorie')->where('id','=',$request['id_cate'])->delete();
            }
            return back();
        }
        else
        {
         abort(404);
        }

    }
}
