<?php

use App\Http\Controllers\AlterarValores;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');



    
    
    
Route::get('/guestdashboard', [GuestController::class, 'guestData'])->name('guestdashboard');


Route::middleware(['auth', 'verified', 'atualizar.dados'])->group(function () {
    
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/admindashboard', 'admindashboard')->name('admindashboard');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/admindashboard/alterarValores', [AlterarValores::class, 'alterarValor'])->name('alterarValor');
});

require __DIR__.'/auth.php';
