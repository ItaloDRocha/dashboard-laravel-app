<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class GuestController extends Controller
{
    public function guestData() : View
    {
        $guestData = file_get_contents('..\resources\json\guestData.json');
        $userData = json_decode($guestData);
        return view ('admindashboard', ['userData' => $userData]);
    }
}
