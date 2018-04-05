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
    
    Route::get('/ultima', 'ResumenController@ultima');
    Route::get('/resumen', 'ResumenController@index');
    Route::get('/resumen/{id_cuenta}', 'ResumenController@find');
    Route::get('/notas/{id_cuenta}', 'NotaController@index');
    Route::get('/migo', 'MigoController@getList');
    Route::get('/queuesg', 'GestorQueuesController@index');
    Route::get('/newqueue', 'GestorQueuesController@changeQueue');
    Route::get('/visits/{id_cuenta}', 'VisitController@index');
    Route::get('/rotas', 'RotasController@index');
    Route::get('/buscar', 'BuscarController@search');
    Route::get('/pagos/{id_cuenta}', 'PagosController@showOne');
    Route::get('/logout/{capt}/{why}', 'LoginController@adminLogout');
    Route::get('/logout/{why}', 'LoginController@logout');
    Route::get('/logout', function () {
        return view('logout');
    });
});
Route::middleware(['auth','admin'])->group(function () {    // Admin only
    Route::get('/reports', function (Request $r) {
        $capt = auth()->user()->iniciales;
        return view('reports')->with('capt', $capt);
    });
    Route::get('/ultimo_mejor', 'BestController@index');
    Route::get('/queues', 'QueuesController@index');
    Route::get('/queues/{gestor}', 'QueuesController@change');
    Route::get('/changest', 'ChangestController@showOne');
    Route::post('/changest', 'ChangestController@updateOne');
    Route::get('/quick', 'QuickController@index');
    Route::get('/queuesqc', 'QueueReportController@index');
    Route::get('/speclistqc', 'SpeclistController@index');
    Route::get('/segmento', 'SegmentController@index');
    Route::post('/segmento/borrar', 'SegmentController@borrar');
    Route::post('/segmento/inactivar', 'SegmentController@inactivar');
    Route::post('/segmento/agregar', 'SegmentController@agregar');
    Route::post('/segmento/segment/agregartodo', 'SegmentController@segment/agregartodo');
    Route::get('/gestoradmin', 'GestoradminController@index');
    Route::get('/gestor/add', 'GestoradminController@agregar');
    Route::get('/gestor/change', 'GestoradminController@cambiar');
    Route::get('/gestor/delete', 'GestoradminController@borrar');
    Route::get('/breakadmin', 'BreaksController@admindex');
    Route::delete('/breakadmin/{auto}', 'BreaksController@borrar');
    Route::put('/breakadmin', 'BreaksController@cambiar');
    Route::post('/breakadmin', 'BreaksController@agregar');
    Route::resource('/trouble', 'TroubleController');
    Route::get('/bigproms/make', 'BigpromsController@makeReport');
    Route::get('/bigproms', 'BigpromsController@index');
    Route::get('/bigquery/make', 'BigqueryController@makeReport');
    Route::get('/bigquery', 'BigqueryController@index');
    Route::get('/bigpagos/make', 'BigpagosController@makeReport');
    Route::get('/bigpagos', 'BigpagosController@index');
    Route::get('/checkoutlist/{gestor}', 'CheckController@listing');
    Route::get('/checkout', 'CheckController@checkout');
    Route::get('/checkout/{gestor}', 'CheckController@checkoutAjax');
    Route::post('/checkout', 'CheckController@assign');
    Route::get('/checkin', 'CheckController@checkin');
    Route::get('/checkin/{gestor}', 'CheckController@checkinAjax');
    Route::post('/checkin', 'CheckController@receive');
    Route::get('/checkboth', 'CheckController@checkboth');
    Route::get('/checkboth/{gestor}', 'CheckController@checkbothAjax');
    Route::post('/checkboth', 'CheckController@assignboth');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
