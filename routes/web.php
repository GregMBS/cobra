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

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('index');
});
    
Route::get('/reports', function (Request $r) {
    dd($r->cookie('auth'));
    $capt = $r->capt;
    return view('reports')->with('capt', $capt);
});

    Route::get('/migo', 'MigoController@userList');
    Route::get('/migoadmin', 'MigoController@adminList');
    Route::get('/changest', 'ChangestController@showOne');
    Route::post('/changest', 'ChangestController@updateOne');
    
Route::post('/login', 'LoginController@login');
