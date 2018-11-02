<?php /** @noinspection ALL */

use App\User;

Route::get('/', function () {
    return view('index');
});

Route::get('/breaks/{capt}', 'BreaksController@index');

Route::middleware('auth')->group(function () {
    
    Route::get('/ultima', 'DebtorController@latest');
    Route::get('/home', 'DebtorController@index');
    Route::get('/resumen', 'DebtorController@index');
    Route::get('/resumen/{id_cuenta}', 'DebtorController@find');
    Route::post('/gestion', 'DebtorController@gestion');
    Route::post('/captura', 'DebtorController@capture');
    Route::get('/notas/{id_cuenta}', 'NoteController@index');
    Route::post('/notas', 'NoteController@add');
    Route::post('/clearNota/{nota_id}', 'NoteController@remove');
    Route::get('/migo', 'AccountsController@getList');
    Route::get('/queuesg', 'AgentQueuesController@index');
    Route::get('/newqueue', 'AgentQueuesController@changeQueue');
    Route::get('/visits/{id_cuenta}', 'VisitController@index');
    Route::get('/rotas', 'PromisesController@index');
    Route::get('/buscar', 'SearchController@search');
    Route::get('/pagos/{id_cuenta}', 'PaymentsController@showOne');
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
    Route::get('/changest', 'ChangeStatusController@showOne');
    Route::post('/changest', 'ChangeStatusController@updateOne');
    Route::get('/quick', 'QuickController@index');
    Route::get('/queuesqc', 'QueueReportController@index');
    Route::get('/speclistqc', 'StatusListController@index');
    Route::get('/segmento', 'SegmentController@index');
    Route::post('/segmento/erase', 'SegmentController@erase');
    Route::post('/segmento/inactivate', 'SegmentController@inactivate');
    Route::post('/segmento/add', 'SegmentController@add');
    Route::post('/segmento/addAll', 'SegmentController@addAll');
    Route::post('/segmento/segment/addAll', 'SegmentController@segment/addAll');
    Route::get('/gestoradmin', 'AgentAdminController@index');
    Route::post('/gestor/add', 'AgentAdminController@add');
    Route::post('/gestor/change', 'AgentAdminController@change');
    Route::post('/gestor/delete', 'AgentAdminController@erase');
    Route::post('/nombre/change', 'OldNamesAdminController@change');
    Route::post('/nombre/delete', 'OldNamesAdminController@erase');
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
    Route::get('/pdh/{gestor}/{fecha}', 'AgentActivityController@promises');
    Route::get('/ddh/{gestor}/{fecha}', 'AgentActivityController@calls');
    Route::get('/pdhv/{gestor}/{fecha}', 'VisitorActivityController@promises');
    Route::get('/ddhv/{gestor}/{fecha}', 'VisitorActivityController@calls');
    Route::get('/activate', 'ActivateController@activeShow');
    Route::post('/activate', 'ActivateController@activate');
    Route::get('/inactivate', 'ActivateController@inactiveShow');
    Route::post('/inactivate', 'ActivateController@inactivate');
    Route::get('/comparativo', 'ComparisonController@index');
    Route::get('/pagosum', 'PaymentsController@summary');
    Route::get('/pagobulk', 'BulkPaymentsController@index');
    Route::post('/pagobulk', 'BulkPaymentsController@confirm');
    Route::get('/intensidad', 'IntensityController@index');
    Route::post('/intensidad', 'IntensityController@makeReport');
    Route::get('/inventario', 'InventoryController@index');
    Route::post('/inventario', 'InventoryController@makeReport');
    Route::get('/inventarioRapid', 'InventoryController@indexRapid');
    Route::post('/inventarioRapid', 'InventoryController@makeRapidReport');
    Route::get('/notadmin', 'NoteController@indexAdmin');
    Route::post('/notadmin', 'NoteController@addAdmin');
    Route::get('/carga', 'LoadController@index');
    Route::post('/carga', 'LoadController@load');
    Route::get('/hour', 'HoursController@select');
    Route::get('/hours', 'HoursController@index');
    Route::get('/hours/{c_cvge}', 'HoursController@show');
    Route::get('/hoursV/{c_visit}', 'HoursController@showV');
    Route::get('/hoursv', 'HoursController@indexV');
    Route::get('/perfmes', 'LastMonthController@index');
    Route::get('/perfmesv', 'LastMonthController@indexV');
});
Auth::routes();
