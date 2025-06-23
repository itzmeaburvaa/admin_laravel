<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\RegController;



Route::resource('clubs', ClubController::class);


Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/form', [ClubController::class, 'index'])->name('form'); // Updated ✅
Route::post('/clubs', [ClubController::class, 'store'])->name('clubs.store'); 
Route::put('/clubs/{id}', [ClubController::class, 'update'])->name('clubs.update');


Route::delete('/clubs/{id}', [ClubController::class, 'destroy'])->name('clubs.destroy');

Route::get('/table', [RegController::class, 'showTable']);
