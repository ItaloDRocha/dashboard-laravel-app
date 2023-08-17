<?php

namespace App\Http\Middleware;

use App\Models\UserData;
use Closure;
use Illuminate\Http\Request;

class AtualizarDados
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $id_user = auth()->user()->id;
        $user_dataClass = new UserData();

        $userData_banco =  $user_dataClass->getData($id_user);
        $userData = $userData_banco[0];
        session(['userData' => $userData]);

        return $next($request);
    }
}
