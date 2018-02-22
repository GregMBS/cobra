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
use App\LoginClass;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('index');
});
    
Route::get('/reports', function (Request $r, LoginClass $lc) {
    $cookie = $r->session()->get('auth', '');
    $capt = $lc->getCapt($cookie);
    return view('reports')->with('capt', $capt);
});

    Route::get('/migo', 'MigoController@userList');
    Route::get('/migoadmin', 'MigoController@adminList');
    Route::get('/changest', 'ChangestController@showOne');
    Route::post('/changest', 'ChangestController@updateOne');
    
    Route::post('/login', 'LoginController@login');
    Route::get('/quick', 'QuickController@index');
    Route::get('/queuesqc', 'QueueReportController@index');
    Route::get('/buscar', 'BuscarController@search');
    Route::get('/pagos/{id_cuenta}', 'PagosController@showOne');
    Route::get('/logout/{capt}/{why}', 'LoginController@adminLogout');
    Route::get('/logout/{why}', 'LoginController@logout');
    Route::get('/logout', function () {
        return view('logout');
    });
        
