<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class GuestController extends Controller
{
    public function guestData() : View
    {
        $guestData = array("profit" => 23523, "growth" => 1721, "orders" => 3685, "customers" => 250);

        $guestData = json_encode($guestData, JSON_PRETTY_PRINT);

        $userData = json_decode($guestData);

        return view ('admindashboard', ['userData' => $userData]);
    }
}
