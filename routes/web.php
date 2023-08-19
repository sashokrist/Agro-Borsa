<?php

use App\Http\Controllers\OfferController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
Route::post('/offers', [OfferController::class, 'store'])->name('offers.store');
Route::put('/offers/{id}', [OfferController::class, 'update'])->name('offers.update');
Route::delete('/offers/{id}', [OfferController::class, 'destroy'])->name('offers.destroy');
Route::get('/offers/{id}', [OfferController::class, 'show'])->name('offers.show');
Route::get('/offers/edit/{id}', [OfferController::class, 'edit'])->name('offers.edit');
