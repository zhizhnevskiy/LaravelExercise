<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ValidateController;
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

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/validate', [HomeController::class, 'home'])->name('home');
Route::post('/validate', [ValidateController::class, 'validateData'])->name('validate');
