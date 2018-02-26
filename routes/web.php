<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('index');
});

Route::get('/breaks/{capt}', 'BreaksController@index');

Route::middleware('auth')->group(function () {
    Route::get('/reports', function (Request $r) {
        $capt = auth()->user()->iniciales;
        return view('reports')->with('capt', $capt);
    });
    
    Route::get('/ultima', 'ResumenController@ultima');
    Route::get('/resumen', 'ResumenController@index');
    Route::get('/resumen/{id_cuenta}', 'ResumenController@find');
    Route::get('/migo', 'MigoController@getList');
    Route::get('/changest', 'ChangestController@showOne');
    Route::post('/changest', 'ChangestController@updateOne');
    Route::get('/rotas', 'RotasController@index');
    Route::get('/quick', 'QuickController@index');
    Route::get('/queuesqc', 'QueueReportController@index');
    Route::get('/buscar', 'BuscarController@search');
    Route::get('/pagos/{id_cuenta}', 'PagosController@showOne');
    Route::get('/logout/{capt}/{why}', 'LoginController@adminLogout');
    Route::get('/logout/{why}', 'LoginController@logout');
    Route::get('/logout', function () {
        return view('logout');
    });
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
