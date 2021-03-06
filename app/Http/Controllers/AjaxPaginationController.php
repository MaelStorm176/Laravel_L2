<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AjaxPaginationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxPagination(Request $request)
    {
        $products = DB::table('commande')->select('*')->where('user_id', Auth::user()->id)->where('statut_prepa', '!=', 'En cours')->orderBy('created_at','desc')->paginate(5);

        if ($request->ajax()) {
            return view('presult', compact('products'));
        }
        return view('historique_commande',compact('products'));
    }

    
}
