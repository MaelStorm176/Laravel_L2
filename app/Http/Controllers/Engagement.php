<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Engagement extends Controller
{

    public function index() {
        $engagements = DB::table('engagement')->select('*')->get();
        return view('engagements')->with('engagements', $engagements);
    }
}
