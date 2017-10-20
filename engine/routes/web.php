<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index');
Route::middleware('auth')->group(function () {
    Route::get('/cabinet/profile', 'CabinetController@profile')->name('profileForm');
    Route::post('/cabinet/profile/update', 'CabinetController@profileUpdate')->name('profileUpdate');
});
