<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormatController;
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

Route::get('/format', [HomeController::class, 'home'])->name('home');
Route::post('/format', [FormatController::class, 'format'])->name('format');
