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
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});

Auth::routes(['verify' => true]);

Route::get('/noscriptpage', function () {
    return view('noscriptpage');
});

Route::resource('/clientes', 'clientcontoller');
Route::resource('/sclientes', 'sclientcontroller');
Route::resource('/Generadores', 'genercontroller');
Route::resource('/sgeneradores', 'sgenercontroller');
Route::resource('/declaraciones', 'DeclarController');
Route::resource('/respels', 'RespelController');
Route::resource('/requerimientos', 'RequerimientoController');
Route::resource('/permisos', 'RolesController');
Route::resource('/audits', 'auditController');
Route::resource('/place/departament', 'DepartamentoController');
Route::resource('/areas','AreaController');
Route::resource('/place/municipal','municipalityController');
Route::resource('/oficces','OficceController');
Route::resource('/cargos','CargoController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
