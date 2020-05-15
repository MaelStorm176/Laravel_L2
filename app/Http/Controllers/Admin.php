<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Admin extends Controller
{
    public function index()
    {
        return view('adm/adm_home');
    }

    public function horaires()
    {
        $horaires = DB::table('horaires')->select('*')->get();
        return view('adm/adm_horaires')->with('horaires',$horaires);
    }

    public function horaires_modif(Request $request)
    {
        $validate_data = Validator::make($request->all(), [
            'midi_modif' => 'required|string',
            'soir_modif' => 'required|string'
        ]);
        if($validate_data->fails()){
            return back()->with('error',"Il y a une erreur avec la modification de votre horaire.");
        }

        DB::table('horaires')->where('id','=',$request['id_modif'])->update([
           'midi' => $request['midi_modif'],
            'soir' => $request['soir_modif']
        ]);

        return back()->with('message',"Votre horaire a été modifié.");
    }

    public function avis()
    {
        return view('adm/adm_avis');
    }

    public function general()
    {
        return view('adm/adm_general');
    }

    public function engagements()
    {
        return view('adm/adm_engagements');
    }

    public function secondaire()
    {
        $carousel=DB::table('accueil_carousel')->select('*')->get();
        $partenaires = DB::table('partenaires')->select('*')->get();
        return view('adm/adm_secondaire',compact('carousel','partenaires'));
    }

    public function partenaire_ajout(Request $request)
    {
        DB::table('partenaires')->updateOrInsert([
            'nom' => $request['nom'],
            'lien' => $request['lien']
        ]);

        return redirect('admin/secondaire');
    }

    public function partenaire_supprimer(Request $request)
    {
        DB::table('partenaires')->where('id','=',$request['id'])->delete();
    }

    public function commandes()
    {
        return view('adm/adm_commandes');
    }

    public function historique_commandes()
    {
        $products = DB::table('commande')->select('*')->where('statut_prepa','!=','En cours')->orderBy('updated_at','DESC')->paginate(5);
        return view('adm/adm_historique_commande', compact('products'));
    }

    public function informations(Request $request)
    {
        if (!empty($request['last_name']) && !empty($request['first_name']))
        {
            $users = DB::table('users')
                ->where('last_name', '=', $request['last_name'])
                ->where('first_name', '=', $request['first_name'])
                ->paginate(15);
        }
        elseif (!empty($request['last_name']))
        {
            $users = DB::table('users')
                ->where('last_name', '=', $request['last_name'])
                ->paginate(15);
        }

        elseif (!empty($request['first_name']))
        {
            $users = DB::table('users')
                ->where('first_name', '=', $request['first_name'])
                ->paginate(15);
        }
        else
        {
            $users = DB::table('users')->paginate(15);
        }
        return view('adm/adm_informations')->with('users',$users);
    }

    public function droits()
    {
        return view('adm/adm_droits');
    }

    public function expulsions()
    {
        return view('adm/adm_expulsions');
    }

    public function codes()
    {
        $coupons = DB::table('coupon')->orderBy('id','desc')->get();
        return view('adm/adm_codes',compact('coupons'));
    }

    public function articles()
    {
        $categorie = DB::table('categorie')->select('*')->get();
        $pizza = DB::table('pizza')->orderBy('id','desc')->get();
        return view('adm/adm_articles',compact('pizza','categorie'));
    }

    public function menus()
    {
        $menus = DB::table('menu')->select('*')->get();
        $contenu_menu_r = DB::table('contenu_menu')->pluck('id_pizza');
        $contenu_menu = DB::table('contenu_menu')->select('id_menu','id_pizza')->get();
        $pizza = DB::table('pizza')->whereIn('id',$contenu_menu_r)->select('nom','categorie','id')->get();
        return view('adm/adm_menus',compact('pizza','menus','contenu_menu'));
    }

    public function promotions()
    {
        $pizza = DB::table('pizza')->select('*')->get();
        $categories = DB::table('categorie')->select('*')->get();
        return view('adm/adm_promotions',compact('pizza','categories'));
    }

    public function refresh_article(Request $request)
    {
        $articles = DB::table('pizza')->where('categorie','=',$request['nom'])->select('id','nom')->get();
        echo '<option name="pizza">-- Selectionner --</option>';
        foreach ($articles as $article)
        {
            echo '<option value="'.$article->id.'">'.$article->nom.'</option>';
        }
    }
}
