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

Route::get('/preguntas-frecuentes', function () {
    return view('preguntas.index');
});

Route::get('qr-code', function () 
{

	$qrCode = new Endroid\QrCode\QrCode('https://sispro.prosarc.com');

	header('Content-Type: '.$qrCode->getContentType());
	// return $qrCode->writeDataUri();
	echo "<img src='".$qrCode->writeDataUri()."'>";
});

/* REGISTRO EXPRESS*/
Route::middleware(['web'])->group(function () {
	Route::get('/registroexpress', 'registroexpressController@create')->name('registroexpress');
	Route::post('/sendregisterexpress', 'registroexpressController@store');
	Route::get('/pdftest', 'serviceexpresscontroller@pdftest');
});



Route::middleware(['web', 'auth', 'verified', 'bindings'])->group(function () {
    //    Route::get('/link1', function ()    {
	//        // Uses Auth Middleware
	//    });
	// Route::get('/', function () {
	// Only verified users may enter...
	
    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
	#adminlte_routes
	Route::post('/changeRol/{id}', 'userController@changeRol');
	Route::resource('/clientes', 'ClientController');
	Route::post('/clientes/{id}/changeComercial', 'ClientController@changeComercial');
	Route::get('/cliente/{slug}', 'ClienteController@show')->name('cliente-show');
	Route::get('/cliente/{slug}/edit', 'ClienteController@edit')->name('cliente-edit');
	Route::put('/cliente/{slug}/update', 'ClienteController@update')->name('cliente-update');
	Route::get('/cliente/{slug}/updateCliStatus', 'ClienteController@updateCliStatus')->name('cliente-updateCliStatus');
	Route::get('/cliente/{slug}/negarCliStatus', 'ClienteController@negarCliStatus')->name('cliente-negarCliStatus');
	Route::get('/cliente/{slug}/TipoFacturacionContado', 'ClienteController@facturacionContado')->name('cliente-facturacionContado');
	Route::get('/cliente/{slug}/TipoFacturacionCredito', 'ClienteController@facturacionCredito')->name('cliente-facturacionCredito');
	Route::get('/clientesexpress', 'ClientController@indexExpress')->name('clientes.clientesExpress');
	Route::resource('/contactos', 'ContactoController');
	Route::post('/contacto-vehiculo-create/{id}', 'VehiculoContactoController@store');
	Route::put('/contacto-vehiculo-edit/{id}', 'VehiculoContactoController@update');
	Route::delete('/contacto-vehiculo-delete/{id}', 'VehiculoContactoController@destroy');
	Route::resource('/sclientes', 'sclientcontroller');
	Route::get('/sede/{slug}/edit', 'SedesAllController@edit')->name('sedes-edit');
	Route::put('/sedes/{slug}/update', 'SedesAllController@update')->name('sedes-update');
	Route::delete('/sedes/{slug}/destroy', 'SedesAllController@destroy')->name('sedes-destroy');
	Route::resource('/generadores', 'genercontroller');
	Route::post('/Soy-Gener/{id}', 'genercontroller@storeSoyGenerador');
	Route::resource('/sgeneradores', 'sgenercontroller');
	Route::resource('/respels', 'RespelController');

	//Cliente tarifas routes

	// Route::get('/cliente/{cliente}/tarifascliente_create', 'ClienteTarifasController@create');
	// Route::post('/cliente/{cliente}/tarifascliente_store', 'ClienteTarifasController@store')->name('cliente-tarifas-store');
	Route::resource('/cliente/{slug}/clientetarifas', 'ClienteTarifasController');
	/*Route::resource('/vencidos', 'RespelController');*/


	Route::get('vencidos', ['as' => 'vencidos', 'uses' => 'RespelController@vencidos']);


	Route::resource('/respelspublic', 'RespelPublicController');
	Route::get('/clientToRp/{id}', 'RespelPublicController@clientToRp');
	Route::get('/rpToClient/{id}', 'RespelPublicController@rpToClient');
	Route::resource('/categorypublic', 'CategoryRPController');
	Route::resource('/subcategorypublic', 'SubCategoryRPController');
	Route::put('/respels/{id}/updateStatusRespel', 'RespelController@updateStatusRespel');
	Route::put('/respels/{id}/makePublicRespel', 'RespelController@makePublicRespel');
	Route::put('/respels/{id}/updateTDE', 'RespelController@updateTDE');
	Route::get('/respelsexpress', 'RespelController@indexExpress')->name('respels.indexExpress');
	Route::post('/respelGener', 'RespelSedeGenerController@storeGener');
	Route::delete('/respelGener/{id}', 'RespelSedeGenerController@destroyGener');
	Route::post('/respelSGener', 'RespelSedeGenerController@storeSGener');
	Route::delete('/respelSGener/{id}', 'RespelSedeGenerController@destroySGener');
	Route::resource('/permisos', 'PermisoUsuarioController');
	Route::get('/permisos/{id}/editpassword','PermisoUsuarioController@editpassword')->name('permisos-edit'); 
	Route::put('/permiso/{id}','PermisoUsuarioController@updatepassword');
	Route::resource('/UsuariosCliente', 'PermisoClienteController');
	Route::get('/UsersClientes', 'PermisoClienteController@usersclientes')->name('users-clientes');
	Route::get('/UsuariosCliente/{id}/editpassword','PermisoClienteController@editpassword')->name('permisos-edit'); 
	Route::put('/UsuarioCliente/{id}','PermisoClienteController@updatepassword');
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
	Route::resource('/programacion-express','ProgramacionExpressController');
	Route::post('/programacion-express/{id}/añadirVehiculo','ProgramacionExpressController@añadirVehiculo');
	Route::put('/programacion-express/{id}/updateStatus','ProgramacionExpressController@updateStatus');
	Route::post('/programacion-express/{id}/sendParafiscales','ProgramacionExpressController@sendParafiscales');


	Route::resource('/vehicle-programacion','VehicProgController');
	Route::put('/vehicle-programacion/{id}/updateStatus','VehicProgController@updateStatus');
	Route::post('/vehicle-programacion/{id}/añadirVehiculo','VehicProgController@añadirVehiculo');
	Route::post('/vehicle-programacion/{id}/sendParafiscales','VehicProgController@sendParafiscales');
	Route::resource('/vehicle-mantenimiento','VehicManteController');
	Route::resource('/tratamiento','TratamientoController');
	Route::resource('/pretratamiento','PretratamientoController');
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
	Route::put('/solicitud-residuo/{id}/corregirSolRes', 'SolicitudResiduoController@corregirSolRes');
	Route::put('/solicitud-residuo/{id}/UpdatePrice', 'SolicitudResiduoController@updateSolResPrice');
	Route::get('/reportes', 'SolicitudResiduoController@reportes')->name('solicitud-residuos.reportes');
	Route::resource('/solicitud-servicio', 'SolicitudServicioController');
	Route::post('/solicitud-servicio/changestatus', 'SolicitudServicioController@changestatus');
	Route::post('/solicitud-servicio/reversarStatus', 'SolicitudServicioController@reversarStatus');
	Route::post('/solicitud-servicio/cancelarServicio', 'SolicitudServicioController@cancelarServicio');
	Route::put('/solicitud-servicio/{id}/updateRms', 'SolicitudServicioController@updateRms');
	Route::get('/solicitud-servicio/{id}/sendtobilling', 'SolicitudServicioController@sendtobilling');
	Route::get('/solicitud-servicio/{id}/add-respel', 'SolicitudServicioController@addRespel');
	Route::put('/solicitud-servicio/{id}/update-respel', 'SolicitudServicioController@updateRespel');
	Route::put('/solicitud-servicio/repeat/{id}', 'SolicitudServicioController@repeat');
	Route::get('/solicitud-servicio/{id}/documentos', 'SolicitudServicioController@solservdocindex')->name('solicitud-servicio.documentos');
	Route::resource('/serviciosexpress', 'ServiceExpressController');
	Route::post('/serviciosexpress/changestatus', 'ServiceExpressController@changestatus');
	Route::post('/serviciosexpress/reversarStatus', 'ServiceExpressController@reversarStatus');
	Route::post('/serviciosexpress/cancelarServicio', 'ServiceExpressController@cancelarServicio');
	Route::put('/serviciosexpress/{id}/updateRms', 'ServiceExpressController@updateRms');
	Route::get('/rutadeldia', 'ServiceExpressController@rutadeldia');
	Route::get('/serviciosexpress/{id}/sendtobilling', 'ServiceExpressController@sendtobilling');
	Route::get('/serviciosexpress/{id}/add-respel', 'ServiceExpressController@addRespel');
	Route::put('/serviciosexpress/{id}/update-respel', 'ServiceExpressController@updateRespel');
	Route::put('/serviciosexpress/repeat/{id}', 'ServiceExpressController@repeat');
	Route::post('/serviciosexpress/certificarExpress', 'ServiceExpressController@certificarExpress');
	Route::get('/serviciosexpress/{id}/documentos', 'ServiceExpressController@solservdocindex')->name('solicitud-servicio.documentos');
	Route::resource('/observacion', 'ObservacionController');
	Route::post('/recepcionerrada', 'ObservacionController@recepcionErrada');
	Route::post('/recordatorio', 'ObservacionController@sendRecordatorio');
	Route::get('/servicioscompletados', 'SolicitudServicioController@serviciosCompletados');
	Route::get('/almacenamiento', 'SolicitudServicioController@indexalmacenados')->name('almacenamiento');
	Route::get('/solicitud-servicio/{id}/documentos/create', 'CertificadoController@create');
	Route::resource('/certificadosexpress', 'CertificadoExpressController');
	Route::get('/certificadosexpress/{id}/firmar/{servicio}', 'CertificadoController@firmar');
	Route::get('/certificadosexpress/{id}/firmar', 'CertificadoController@firmarindex');
	Route::get('/certificadosexpress/{id}/wordtemplate', 'CertificadoController@wordtemplate');
	Route::post('/certificadosexpress/{id}/independiente', 'CertificadoController@independiente');
	Route::resource('/certificados', 'CertificadoController');
	Route::get('/certificados/{id}/firmar/{servicio}', 'CertificadoController@firmar');
	Route::get('/certificados/{id}/firmar', 'CertificadoController@firmarindex');
	Route::get('/certificados/{id}/wordtemplate', 'CertificadoController@wordtemplate');
	Route::post('/certificados/{id}/independiente', 'CertificadoController@independiente');
	Route::resource('/verificationcodes', 'VerificationCodeController');
	Route::resource('/groupcodes', 'GroupCodeController');
	Route::resource('/verifycodes', 'VerificationCodeController');
	Route::resource('/manifiestos', 'ManifiestoController');
	Route::get('/manifiestos/{id}/firmar/{servicio}', 'ManifiestoController@firmar');
	Route::get('/manifiestos/{id}/firmar', 'ManifiestoController@firmarindex');
	Route::resource('/articulos-proveedor', 'ArticuloXProveedorController');
	Route::resource('/code', 'QrCodesController');
	Route::resource('/horario', 'HorarioController');
	// Route::resource('/asistencias', 'AsistenciaController');
	Route::resource('/recurso', 'RecursoController');
	Route::resource('/requerimientos', 'RequerimientoController');
	Route::put('/requerimientos/{id}/updateTrat/{servicio}', 'RequerimientoController@updateTrat')->name('requerimientos.updateTrat');
	Route::resource('/holidays', 'holidayController');
	Route::resource('/cotizacion', 'CotizacionController');
	Route::resource('/tarifas', 'TarifaController');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/logout', 'Auth\LoginController@logout');
	Route::get('/sclientes/{id}', 'sclientcontroller@getMunicipio');
	Route::get('/ClasificacionA', function(){return view('layouts.RespelPartials.ClasificacionA');})->name('ClasificacionA'); 
	Route::get('/ClasificacionY', function(){return view('layouts.RespelPartials.ClasificacionY');})->name('ClasificacionY');
	Route::resource('/contratos', 'ContratoController');
	Route::resource('/requeri-client', 'RequerimientosClienteController');
	/*Rutas de peticiones de Ajax*/
	// Route::get('/muni-depart/{id}', 'AjaxController@MuniDepart');
	Route::get('/doc-number/{id}', 'AjaxController@DocNumber');
	Route::get('/area-sede/{id}', 'AjaxController@AreasSedes');
	Route::get('/cargo-area/{id}', 'AjaxController@CargosAreas');
	Route::put('/CambioDeFechaProgVehic/{id}', 'AjaxController@CambioDeFecha');
	Route::get('/RespelGener/{id}', 'AjaxController@RespelGener');
	Route::get('/sedegener-respel/{id}', 'AjaxController@SGenerRespel');
	Route::get('/contacto-vehiculos/{id}', 'AjaxController@VehiculosContacto');
	Route::get('/RequeRespel/{id}', 'AjaxController@RequeRespel');
	Route::get('/vehicle-transport/{id}', 'AjaxController@VehicTransport');
	Route::get('/preTratamientoDinamico/{id}', 'AjaxController@preTratamientoDinamico');
	Route::get('/SubcategoriaDinamico/{id}', 'AjaxController@SubcategoriaDinamico');
	Route::get('/verificarduplicado/{numero}/{type}', 'AjaxController@verificarDuplicado');
	Route::get('/certificarservicio/{servicio}', 'AjaxController@certificarServicio');
	Route::post('/facturarservicio/{servicio}', 'AjaxController@facturarServicio');
	Route::post('/recordatorioAjax', 'AjaxController@sendRecordatorio');
	Route::get('/renewtokenaftererror', 'AjaxController@renewTokenAfterError');
	Route::put('/firmarCertificado/{slug}', 'AjaxController@firmarCertificado')->name('certificados.ajaxfirmar');
	Route::get('/ClienteExpress-Residuos/{id}', 'AjaxController@clienteExpressResiduos');
	Route::resource('/prefacturas', 'PrefacturaController');
	
	/*Rutas de generacion de PDF*/
	Route::get('/PdfManiCarg/{id}','PdfController@PdfManiCarg');
	/*Rutas de envio de e-mail */
	Route::get('/email-solser/{slug}', 'EmailController@sendemail')->name('email-solser');
	Route::get('/email-respel/{slug}', 'EmailController@sendEmailRespel')->name('email-respel');
});

Route::get('/muni-depart/{id}', 'AjaxController@MuniDepart');
