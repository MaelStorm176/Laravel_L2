<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PaymentAccepted extends Controller
{
    public static function redirect(){


        return redirect('/home');


    }
}
