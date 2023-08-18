<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\UserData;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    // /**
    //  * Handle an incoming authentication request.
    //  */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $id_user = auth()->user()->id;

        $user_dataClass = new UserData;

        $userData_banco =  $user_dataClass->getData($id_user);

        //Verifica se precisa criar os dados do usuário

        if ($userData_banco->count() == 0) {
            echo $user_dataClass->createData($id_user);
        } 

        return redirect()->route('admindashboard');
        
        // return redirect()->route('admindashboard')->with(['userData' => $userData]);

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
