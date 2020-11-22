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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'CotizacionController@index');
// Route::get('/', 'HomeController@index');
Route::get('/new_cotizacion', 'CotizacionController@cotizacion');
Route::post('/edit_cotizacion', 'CotizacionController@Edit_cotizacion');
Route::post('/insert_update_cotizacion', 'CotizacionController@insert_update');
// Route::get('/pdf','CotizacionController@PDF');
// Route::post('/view_cotizacion', 'CotizacionController@index_cotizacion');

Route::post('/index_concepto', 'ConceptoController@index');
Route::post('/insert_concepto', 'ConceptoController@insert');
Route::post('/update_concepto', 'ConceptoController@update');
Route::post('/delete', 'ConceptoController@delete');

Route::post('/insert_termino', 'TerminoController@insert');
Route::post('/index_termino', 'TerminoController@index');
Route::post('/update_termino', 'TerminoController@update');
Route::post('/delete_t','TerminoController@delete');

Route::post('/index_previa', 'PreviaController@index');
Route::post('/save_color', 'PreviaController@save_color');
Route::post('/pdf','PreviaController@PDF');
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
