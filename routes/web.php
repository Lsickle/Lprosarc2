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

Route::get('/', function () {
    return redirect()->route('home');
});


Auth::routes(['verify' => true]);

Route::get('/noscriptpage', function () {
    return view('noscriptpage');
});

/*Rutas del usuario*/
Route::get('/profile/{id}', 'userController@show')->name('profile');
Route::get('/profile/{id}/edit', 'userController@edit');
Route::put('/profile/{id}','userController@update');
Route::get('/profile/{id}/passwordreset', 'userController@viewchangepassword')->name('profile.changepassword');
Route::patch('/profile/{id}', 'userController@changepassword');

Route::middleware(['auth', 'verified'])->group(function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });
// Route::get('/', function () {
	// Only verified users may enter...
	


    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
	#adminlte_routes
	Route::post('/changeRol/{id}', 'userController@changeRol');
	Route::resource('/clientes', 'clientcontoller');
	Route::get('/cliente/{slug}', 'ClienteController@show')->name('cliente-show');
	Route::get('/cliente/{slug}/edit', 'ClienteController@edit')->name('cliente-edit');
	Route::put('/cliente/{slug}/update', 'ClienteController@update')->name('cliente-update');
	Route::resource('/contactos', 'ContactoController');
	Route::post('/contacto-vehiculo-create/{id}', 'VehiculoContactoController@store');
	Route::put('/contacto-vehiculo-edit/{id}', 'VehiculoContactoController@update');
	Route::delete('/contacto-vehiculo-delete/{id}', 'VehiculoContactoController@destroy');
	Route::resource('/sclientes', 'sclientcontroller');
	Route::get('/sedes', 'SedesAllController@index')->name('sedes');
	Route::get('/sedes/{id}', 'SedesAllController@show')->name('sede-show');
	Route::resource('/generadores', 'genercontroller');
	Route::get('/Soy-Gener/{id}', 'genercontroller@storeSoyGenerador');
	Route::resource('/sgeneradores', 'sgenercontroller');
	Route::resource('/respels', 'RespelController');
	Route::put('/respels/{id}/updateStatusRespel', 'RespelController@updateStatusRespel');
	Route::post('/respelGener', 'RespelSedeGenerController@storeGener');
	Route::delete('/respelGener/{id}', 'RespelSedeGenerController@destroyGener');
	Route::post('/respelSGener', 'RespelSedeGenerController@storeSGener');
	Route::delete('/respelSGener/{id}', 'RespelSedeGenerController@destroySGener');
	Route::resource('/permisos', 'PermisoUsuarioController');
	Route::get('/permisos/{id}/editpassword','PermisoUsuarioController@editpassword')->name('permisos-edit'); 
	Route::put('/permiso/{id}','PermisoUsuarioController@updatepassword');
	Route::resource('/audits', 'auditController');
	Route::resource('/place/departament', 'DepartamentoController');
	Route::resource('/areas','AreaController');
	Route::resource('/areasInterno','AreaInternoController');
	Route::resource('/place/municipal','municipalityController');
	Route::resource('/cargos','CargoController');
	Route::resource('/cargosInterno','CargoInternoController');
	Route::resource('/personal', 'PersonalController');
	Route::resource('/personalInterno', 'PersonalInternoController');
	Route::resource('/vehicle','VehicleController');
	Route::resource('/vehicle-programacion','VehicProgController');
	Route::resource('/vehicle-mantenimiento','VehicManteController');
	Route::resource('/tratamiento','TratamientoController');
	Route::resource('/asistencia', 'AssistancesController');
	Route::resource('/compra/orden','OrdenCompraController');
	// Route::resource('/compra/cotizacion','QuotationController');
	Route::resource('/activos','ActivoController');
	Route::resource('/movimiento-activos','MovimientoActivoController');
	Route::resource('/capacitacion','TrainingsController');
	Route::resource('/capacitacion-personal','TrainingPersonalsController');
	Route::resource('/inventariotech', 'InventarioTechonologiesController');
	// Route::resource('/recibo-material', 'ReciboMaterialController');
	// Route::resource('/respel-envios', 'RespelEnviosController');
	Route::resource('/solicitud-residuo', 'SolicitudResiduoController');
	Route::put('/solicitud-residuo/{id}/Update', 'SolicitudResiduoController@updateSolRes');
	Route::resource('/solicitud-servicio', 'SolicitudServicioController');
	Route::post('/solicitud-servicio/changestatus', 'SolicitudServicioController@changestatus');
	Route::resource('/certificado', 'CertificadoController');
	Route::resource('/manifiesto', 'ManifiestoController');
	Route::resource('/articulos-proveedor', 'ArticuloXProveedorController');
	Route::resource('/code', 'QrCodesController');
	Route::resource('/horario', 'HorarioController');
	// Route::resource('/asistencias', 'AsistenciaController');
	Route::resource('/recurso', 'RecursoController');
	Route::resource('/requerimientos', 'RequerimientoController');
	Route::resource('/holidays', 'holidayController');
	Route::resource('/cotizacion', 'CotizacionController');
	Route::resource('/tarifas', 'TarifaController');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/logout', 'Auth\LoginController@logout');
	Route::get('/sclientes/{id}', 'sclientcontroller@getMunicipio');
	Route::get('/ClasificacionA', function(){return view('layouts.RespelPartials.ClasificacionA');})->name('ClasificacionA');
	Route::get('/ClasificacionY', function(){return view('layouts.RespelPartials.ClasificacionY');})->name('ClasificacionY');
	/*Rutas de peticiones de Ajax*/
	Route::get('/muni-depart/{id}', 'AjaxController@MuniDepart');
	Route::get('/area-sede/{id}', 'AjaxController@AreasSedes');
	Route::get('/cargo-area/{id}', 'AjaxController@CargosAreas');
	Route::put('/CambioDeFechaProgVehic/{id}', 'AjaxController@CambioDeFecha');
	Route::get('/RespelGener/{id}', 'AjaxController@RespelGener');
	Route::get('/sedegener-respel/{id}', 'AjaxController@SGenerRespel');
	Route::get('/contacto-vehiculos/{id}', 'AjaxController@VehiculosContacto');
	Route::get('/RequeRespel/{id}', 'AjaxController@RequeRespel');
	Route::get('/vehicle-transport/{id}', 'AjaxController@VehicTransport');
	/*Rutas de generacion de PDF*/
	Route::get('/PdfManiCarg/{id}','PdfController@PdfManiCarg');
	/*Rutas de envio de e-mail */
	Route::get('/email/{slug}', 'EmailController@sendemail')->name('email');
});

