<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Auth;

class CheckRestauration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $droit = DB::table('droits')->where('user_id', Auth::user()->id)->get();
        $message = 'Vous n\'avez pas les droits pour acceder à cette categorie.';

        if($droit->isEmpty()){
            return redirect()->route('admin')->withMessage($message);
        } else {
            if($droit[0]->restauration == 0){
                return redirect()->route('admin')->withMessage($message);
            }
        }
        return $next($request);
    }
}
