<?php

namespace App\Http\Middleware;

use Closure;

class CheckBanned
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
        if (auth()->check() && auth()->user()->ban && now()->lessThan(auth()->user()->ban)) {
            $ban_jours = now()->diffInDays(auth()->user()->ban);
            auth()->logout();

            $message = 'Votre compte a été suspendu pour '.$ban_jours.' jour(s).';
            return redirect()->route('/')->withMessage($message);
        }

        return $next($request);
    }
}
