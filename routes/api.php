<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('unidads','ApiController@getUnidads')->name('unidads.getUnidads');
Route::get('componentes','ApiController@getComponentes')->name('componentes.getComponentes');
Route::get('tickets/{id}/ticket','ApiController@getTicket')->name('tickets.getTicket');

Route::get('api-funcionarios/{carnet}','ApiController@getFuncionario')->name('funcionarios.getFuncionario');
Route::get('api-funcionarios','ApiController@getFuncionarios')->name('funcionarios.getFuncionarios');