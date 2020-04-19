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
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => $request->prix_p*100,
            "currency" => "eur",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);
        $piz = DB::table("pizza")->select('*')->get();
        foreach ($piz as $key){
            $piz_name = $key->nom;
            $piz_id = $key->id;
        }
        DB::table("commande")->insert([
            'prix_p' =>$request->prix_p,
            'nom_p' =>$request->nom_p,
            'id_pizza'=>  $piz_id,
            'user_id'=>$request->user_id,
            'user_name'=>$request->user_name,
            'statut_prepa'=>'En cours',
            'statut_p'=>'Validé',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        $validate_data = Validator::make($request->all(), [
            'card_name' => 'required',
            'card_number' => 'required',
            'card_cvc' => 'required',
            'card_mm' => 'required',
            'card_yyyy' => 'required',
        ]);

        if($validate_data->fails()) {
            return redirect('/payment_accepted');
            Session::flash('error', 'Payment successful!');
        }
        else{
        Session::flash('success', 'Payment successful!');
        return redirect('/payment_accepted');
        }
    }

}
