<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Stripe;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parametres = DB::table('parametres')->where('id', 1)->get();
        list($prix_total,$products,$menu,$q_tot) = $this->commande_finale();
        return view('payment',compact('products','menu','prix_total','q_tot', 'parametres'));
    }

    public function stripe()
    {
        return view('stripe');
    }

    public function commande_finale()
    {
        $id_panier = DB::table('panier')
            ->where('user_id',"=",auth()->user()->id)
            ->where('type_panier','=',FALSE)
            ->value('id');
        $products = DB::table('pizza')
            ->join('contenu_panier', 'pizza.id', '=', 'contenu_panier.id_pizza')
            ->where('contenu_panier.id_panier', '=' , $id_panier)
            ->select('*')
            ->get();
        $menu = DB::table('menu')
            ->join('contenu_panier', 'menu.id', '=', 'contenu_panier.id_menu')
            ->where('contenu_panier.id_panier', '=' , $id_panier)
            ->select('promo','contenu_panier.quantite','nom','contenu_panier.id')
            ->get();
        $prix_total = 0;
        $q_tot = 0;
        foreach ($products as $key) {
            $prix_total += ($key->promo) * ($key->quantite);
            $q_tot += $key->quantite;
        }
        foreach ($menu as $key) {
            $prix_total += ($key->promo) * ($key->quantite);
            $q_tot += $key->quantite;
        }
        return array($prix_total,$products,$menu,$q_tot);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    public function stripePost(Request $request)
    {
        $validate_data = Validator::make($request->all(), [
            'card_name' => 'required',
            'card_number' => 'required|size:16',
            'card_cvc' => 'required|integer|min:0',
            'card_mm_yyyy' => 'required',
            'prix_total' => 'required|numeric|min:1|max:255'
        ]);

        if($validate_data->fails()) {
            session(['message' => 'Il y a une erreur']);
            return redirect('/panier');
        }
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => ($request->prix_total)*100,
            "currency" => "eur",
            "source" => 'tok_visa',
            "description" => 'Test de payement pour la pizzeria'
        ]);

        //J'INSERE EN BASE LA COMMANDE
        $id_panier = DB::table('panier')
            ->where('user_id',"=",$request->user_id)
            ->where('type_panier','=',FALSE)
            ->value('id');
        DB::table("commande")->insert([
            'prix_total' =>$request->prix_total,
            'num_commande' =>$request->num_commande.'_'.time(),
            'user_id'=>$request->user_id,
            'id_panier' => $id_panier,
            'statut_prepa'=>'En cours',
            'statut_pay'=>'Validé',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        //JE VIDE LE PANIER
        //DB::table('contenu_panier')->where('id_panier','=',$id_panier)->delete();
        DB::table('panier')->where('id','=',$id_panier)->update(['type_panier' => TRUE]);

        //J'AJOUTE L'ADRESSE DANS LA TABLE USERS
        DB::table('users')->where('id','=',$request->user_id)->update(['adresse'=>$request->address]);

        //POINTS FIDELITES
        $parametres = DB::table('parametres')->where('id', 1)->get();
        $nb_comm = DB::table('commande')->where('user_id',$request->user_id)->count();

        foreach($parametres as $key){
            if($nb_comm % $key->ptsNbComm == 0 && $request->prix_total >= $key->ptsMinTotal){
                $nbPoints_actuel = DB::table('users')->select('pointsFidelite')->where('id', $request->user_id)->get();
                DB::table('users')->where('id', $request->user_id)->update([
                    'pointsFidelite' => $nbPoints_actuel[0]->pointsFidelite + $key->ptsGain
                ]);
            }
        }

        return redirect('/payment_accepted');
    }

    public function testvalidite(Request $request) {
        $bool = 0;
        $coupon = DB::table('coupon')->select('code')->get();
        if (isset($request['code'])) {
            foreach($coupon as $key) {
                $code = $request['code'];
                if ($code == $key->code) {
                    $date = DB::table('coupon')->where('code',"=", $key->code)->value('date_limite');
                    if($date < date("Y-m-d"))
                    {
                        DB::table('coupon')->where('code',"=", $key->code)->delete();
                    }
                    $bool = DB::table('coupon')->where('code',"=", $key->code)->value('valide');
                    $remise = DB::table('coupon')->where('code',"=", $key->code)->value('remise');
                    $remise = (100-$remise)/100;
                    echo $bool.'/'.$remise.'/'.$code;
                }
            }
        }
    }

    public function utiliser_points(Request $request){
        if ($request->ajax()) {
            if($request['nbPoints'] <= Auth::user()->pointsFidelite && $request['nbPoints'] > 0 && $request['nbPoints'] % 1 === 0){
                DB::table('users')->where('email', Auth::user()->email)->update([
                    'pointsFidelite' => Auth::user()->pointsFidelite - $request['nbPoints']
                ]);
                echo TRUE;
            } else {
                echo FALSE;
            }
        }
        else
        {
            abort(404);
        }
    }

}
