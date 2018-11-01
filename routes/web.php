<?php /** @noinspection ALL */

use App\User;

Route::get('/', function () {
    return view('index');
});

Route::get('/breaks/{capt}', 'BreaksController@index');

Route::middleware('auth')->group(function () {
    
    Route::get('/ultima', 'ResumenController@latest');
    Route::get('/home', 'ResumenController@index');
    Route::get('/resumen', 'ResumenController@index');
    Route::get('/resumen/{id_cuenta}', 'ResumenController@find');
    Route::post('/gestion', 'ResumenController@gestion');
    Route::post('/captura', 'ResumenController@capture');
    Route::get('/notas/{id_cuenta}', 'NotaController@index');
    Route::post('/notas', 'NotaController@add');
    Route::post('/clearNota/{nota_id}', 'NotaController@remove');
    Route::get('/migo', 'MigoController@getList');
    Route::get('/queuesg', 'GestorQueuesController@index');
    Route::get('/newqueue', 'GestorQueuesController@changeQueue');
    Route::get('/visits/{id_cuenta}', 'VisitController@index');
    Route::get('/rotas', 'RotasController@index');
    Route::get('/buscar', 'SearchController@search');
    Route::get('/pagos/{id_cuenta}', 'PagosController@showOne');
    Route::get('/logout/{capt}/{why}', 'LoginController@adminLogout');
    Route::get('/logout/{why}', 'LoginController@logout');
    Route::get('/logout', function () {
        return view('logout');
    });
    Route::get('/imageUpload/{id_cuenta}', 'ImageUploadController@index');
    Route::post('/imageUpload', 'ImageUploadController@load');
    Route::get('/documents/{id}', 'DocumentController@index');
    Route::post('/documents/{id}', 'DocumentController@store');
    Route::delete('/documents/{id}/{docId}', 'DocumentController@remove');
});
Route::middleware(['auth','admin'])->group(function () {    // Admin only
    Route::get('/home', function () {
        /**
         * @var User $user
         */
        $user = auth()->user();
        $capt = $user->iniciales;
        return view('reports')->with('capt', $capt);
    });
    Route::get('/reports', function () {
        /**
         * @var User $user
         */
        $user = auth()->user();
        $capt = $user->iniciales;
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
    Route::post('/segmento/erase', 'SegmentController@erase');
    Route::post('/segmento/inactivate', 'SegmentController@inactivate');
    Route::post('/segmento/add', 'SegmentController@add');
    Route::post('/segmento/addAll', 'SegmentController@addAll');
    Route::post('/segmento/segment/addAll', 'SegmentController@segment/addAll');
    Route::get('/gestoradmin', 'GestoradminController@index');
    Route::post('/gestor/add', 'GestoradminController@add');
    Route::post('/gestor/change', 'GestoradminController@change');
    Route::post('/gestor/delete', 'GestoradminController@erase');
    Route::post('/nombre/change', 'NombresadminController@change');
    Route::post('/nombre/delete', 'NombresadminController@erase');
    Route::get('/breakAdmin', 'BreaksController@admIndex');
    Route::delete('/breakAdmin/{auto}', 'BreaksController@erase');
    Route::put('/breakAdmin', 'BreaksController@change');
    Route::post('/breakAdmin', 'BreaksController@add');
    Route::resource('/trouble', 'TroubleController');
    Route::get('/bigProms/make', 'BigPromsController@makeReport');
    Route::get('/bigProms', 'BigPromsController@index');
    Route::get('/bigQuery/make', 'BigQueryController@makeReport');
    Route::get('/bigQuery', 'BigQueryController@index');
    Route::get('/checkoutlist/{gestor}', 'CheckController@listing');
    Route::get('/checkout', 'CheckController@checkout');
    Route::get('/checkout/{gestor}', 'CheckController@checkoutAjax');
    Route::post('/checkout', 'CheckController@assign');
    Route::get('/checkin', 'CheckController@checkIn');
    Route::get('/checkin/{gestor}', 'CheckController@checkInAjax');
    Route::post('/checkin', 'CheckController@receive');
    Route::get('/checkboth', 'CheckController@checkBoth');
    Route::get('/checkboth/{gestor}', 'CheckController@checkBothAjax');
    Route::post('/checkboth', 'CheckController@assignboth');
    Route::get('/pdh/{gestor}/{fecha}', 'DhController@promesas');
    Route::get('/ddh/{gestor}/{fecha}', 'DhController@gestiones');
    Route::get('/pdhv/{gestor}/{fecha}', 'DhvController@promesas');
    Route::get('/ddhv/{gestor}/{fecha}', 'DhvController@gestiones');
    Route::get('/activate', 'ActivateController@activeShow');
    Route::post('/activate', 'ActivateController@activate');
    Route::get('/inactivate', 'ActivateController@inactiveShow');
    Route::post('/inactivate', 'ActivateController@inactivate');
    Route::get('/comparativo', 'ComparisonController@index');
    Route::get('/pagosum', 'PagosController@summary');
    Route::get('/pagobulk', 'PagobulkController@index');
    Route::post('/pagobulk', 'PagobulkController@confirm');
    Route::get('/intensidad', 'IntensidadController@index');
    Route::post('/intensidad', 'IntensidadController@makeReport');
    Route::get('/inventario', 'InventarioController@index');
    Route::post('/inventario', 'InventarioController@makeReport');
    Route::get('/inventarioRapid', 'InventarioController@indexRapid');
    Route::post('/inventarioRapid', 'InventarioController@makeRapidReport');
    Route::get('/notadmin', 'NotaController@indexAdmin');
    Route::post('/notadmin', 'NotaController@addAdmin');
    Route::get('/carga', 'LoadController@index');
    Route::post('/carga', 'LoadController@cargar');
    Route::get('/horario', 'HorariosController@select');
    Route::get('/horarios', 'HorariosController@index');
    Route::get('/horarios/{c_cvge}', 'HorariosController@show');
    Route::get('/horariosV/{c_visit}', 'HorariosController@showV');
    Route::get('/horariosv', 'HorariosController@indexV');
    Route::get('/perfmes', 'PerfmesController@index');
    Route::get('/perfmesv', 'PerfmesController@indexV');
});
Auth::routes();
