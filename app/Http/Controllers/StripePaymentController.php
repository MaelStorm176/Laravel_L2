<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
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
        list($prix_total,$products,$q_tot) = $this->commande_finale();
        return view('payment',compact('products','prix_total','q_tot'));
    }

    public function stripe()
    {
        return view('stripe');
    }

    public function commande_finale()
    {
        $id_panier = auth::user()->id_panier;
        $products = DB::table('pizza')
            ->join('contenu_panier', 'pizza.id', '=', 'contenu_panier.id_pizza')
            ->where('contenu_panier.id_panier', '=' , $id_panier)
            ->select('promo','contenu_panier.quantite','nom','statut')
            ->get();
        $prix_total = 0;
        $q_tot = 0;
        foreach ($products as $key) {
            $prix_total += ($key->promo) * ($key->quantite);
            $q_tot += $key->quantite;
        }
        return array($prix_total,$products,$q_tot);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    public function stripePost(Request $request)
    {
        /*
        $validate_data = Validator::make($request->all(), [
            'card_name' => 'required',
            'card_number' => 'required',
            'card_cvc' => 'required',
            'card_mm_yyyy' => 'required',
        ]);

        if($validate_data->fails()) {
            return redirect('/pizza_all');
            Session::flash('error', 'Payment successful!');
        }
        */

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => ($request->prix_total)*100,
            "currency" => "eur",
            "source" => 'tok_visa',
            "description" => 'Test de payement pour la pizzeria'
        ]);

        //J'INSERE EN BASE LA COMMANDE
        $id_panier = DB::table('panier')->where('user_id',"=",$request->user_id)->value('id');
        DB::table("commande")->insert([
            'prix_total' =>$request->prix_total,
            'num_commande' =>$request->num_commande.'_'.time(),
            'id_panier' => $id_panier,
            'user_id'=>$request->user_id,
            'user_email'=>$request->user_email,
            'statut_prepa'=>'En cours',
            'statut_pay'=>'Validé',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //JE VIDE LE PANIER
        DB::table('contenu_panier')->where('id_panier','=',$id_panier)->delete();

        Session::flash('success', 'Payment successful!');
        return redirect('/payment_accepted');
    }

    public function testvalidite(Request $request) {
        $bool = 0;
        $coupon = DB::table('coupon')->select('code')->get();
        if (isset($request['code'])) {
            foreach($coupon as $key) {
                $code = $request['code'];
                if ($code == $key->code) {
                    $bool = DB::table('coupon')->where('code',"=", $key->code)->value('valide');
                    $remise = DB::table('coupon')->where('code',"=", $key->code)->value('remise');
                    $remise = (100-$remise)/100;
                    echo $bool.'/'.$remise.'/'.$code;
                }
            }
        }
    }


}
