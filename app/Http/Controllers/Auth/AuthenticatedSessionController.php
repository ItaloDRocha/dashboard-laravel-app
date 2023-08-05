<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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
    public function store(LoginRequest $request) :RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $userData = array("profit" => 23.523, "growth" => 17.21, "orders" => 3685, "customers" => 269);
        

        $userData = json_encode($userData, JSON_PRETTY_PRINT);

        $userData = json_decode($userData);

        // echo var_dump($guestData);

        $teste_array = array('1','2','3','4','5');
        
        // $userData = serialize($userData);

        // echo var_dump($userData);
        // return view ('admindashboard', ['userData' => $userData]);

        // return redirect()-> intended() -> view ('admindashboard', ['userData' => $userData,'testeroni' => $testeroni]);

        session(['userData' => $userData]);

        return redirect()->route('admindashboard');
        // return redirect()->route('admindashboard')->with(['userData' => $userData]);
        
        

        // return redirect()->route('admindashboard', ['testeroni' => "testerones"]);
        
        // return response() ->view('admindashboard','testeroni' => $testeroni, 200);
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
