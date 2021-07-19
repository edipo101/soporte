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
    return redirect('/home');
});

Auth::routes();

//-----------------------------------
// RUTAS PARA LOS INVITADOS
//-----------------------------------
Route::group(['middleware' => ['guest']], function(){
    Route::get('/invitado', 'HomeController@invitado');
    Route::get('/generar/{tipo}','HomeController@generarticket')->name('home.generar');
    Route::post('/generar', 'HomeController@storeticket')->name('home.storeticket');
    Route::get('/generar/{ticket}/ticket', 'HomeController@ticket')->name('home.ticket');
	Route::get('generar/{ticket}/imprimir', 'HomeController@imprimirticket')->name('home.imprimir');
});

// ------------------------------------
//RUTAS PARA LOS QUE ESTAN AUTENTIFICADOS
//-------------------------------------
Route::group(['middleware' => ['auth']], function(){
    Route::get('/home', 'HomeController@index')->name('home');

    /**
     * Rutas para el modulo de Direccion
     */
    Route::get('direccions','DireccionController@index')->name('direccions.index')->middleware('permission:direccions.index');
    Route::get('direccions/apiDireccions','DireccionController@apiDireccions')->name('direccions.apiDireccions')->middleware('permission:direccions.index');

    Route::get('direccions/create','DireccionController@create')->name('direccions.create')->middleware('permission:direccions.create');
    Route::post('direccions/store','DireccionController@store')->name('direccions.store')->middleware('permission:direccions.create');

    Route::get('direccions/{direccion}/edit','DireccionController@edit')->name('direccions.edit')->middleware('permission:direccions.edit');
    Route::put('direccions/{direccion}','DireccionController@update')->name('direccions.update')->middleware('permission:direccions.edit');

    Route::delete('direccions/{direccion}/delete','DireccionController@destroy')->name('direccions.destroy')->middleware('permission:direccions.destroy');

    Route::get('direccions/importar','DireccionController@importar')->name('direccions.importar')->middleware('permission:direccions.importar');
    Route::post('direccions/importar','DireccionController@storeimportar')->name('direccions.storeimportar')->middleware('permission:direccions.importar');
    
    Route::post('direccions/{direccion}/observado','DireccionController@observar')->name('direccions.observar')->middleware('permission:direccions.observado');
    Route::get('direccions/{direccion}/quitarobservaciones','DireccionController@quitarobservaciones')->name('direccions.quitarobservaciones')->middleware('permission:direccions.observado');

    /**
     * Rutas para mostrar, eliminar y listar fotografias
     */
    Route::get('fotos/{foto}/show', 'FotoController@show')->name('fotos.show');
    Route::delete('fotos/{foto}/delete', 'FotoController@destroy')->name('fotos.delete');
    Route::get('fotos/apiFotos/{id}/{tipo}','FotoController@apiFotos')->name('fotos.apiFotos');

    Route::group(['prefix' => 'configuraciones'], function(){
        /**
         * Rutas para el modulo de Unidad
         */
        Route::get('unidads','UnidadController@index')->name('unidads.index')->middleware('permission:unidads.index');
        Route::get('unidads/apiUnidads','UnidadController@apiUnidads')->name('unidads.apiUnidads')->middleware('permission:unidads.index');

        Route::get('unidads/create','UnidadController@create')->name('unidads.create')->middleware('permission:unidads.create');
        Route::post('unidads/store','UnidadController@store')->name('unidads.store')->middleware('permission:unidads.create');

        Route::get('unidads/{unidad}/edit','UnidadController@edit')->name('unidads.edit')->middleware('permission:unidads.edit');
        Route::put('unidads/{unidad}','UnidadController@update')->name('unidads.update')->middleware('permission:unidads.edit');

        Route::delete('unidads/{unidad}/delete','UnidadController@destroy')->name('unidads.destroy')->middleware('permission:unidads.destroy');

        /**
         * Rutas para el modulo de Componente
         */
        Route::get('componentes','ComponenteController@index')->name('componentes.index')->middleware('permission:componentes.index');
        Route::get('componentes/apiComponentes','ComponenteController@apiComponentes')->name('componentes.apiComponentes')->middleware('permission:componentes.index');

        Route::get('componentes/create','ComponenteController@create')->name('componentes.create')->middleware('permission:componentes.create');
        Route::post('componentes/store','ComponenteController@store')->name('componentes.store')->middleware('permission:componentes.create');

        Route::get('componentes/{componente}/edit','ComponenteController@edit')->name('componentes.edit')->middleware('permission:componentes.edit');
        Route::put('componentes/{componente}','ComponenteController@update')->name('componentes.update')->middleware('permission:componentes.edit');

        Route::delete('componentes/{componente}/delete','ComponenteController@destroy')->name('componentes.destroy')->middleware('permission:componentes.destroy');

        /**
         * Rutas para el modulo de Diagnostico
         */
        Route::get('diagnosticos','DiagnosticoController@index')->name('diagnosticos.index')->middleware('permission:diagnosticos.index');
        Route::get('diagnosticos/apiDiagnosticos','DiagnosticoController@apiDiagnosticos')->name('diagnosticos.apiDiagnosticos')->middleware('permission:diagnosticos.index');

        Route::get('diagnosticos/create','DiagnosticoController@create')->name('diagnosticos.create')->middleware('permission:diagnosticos.create');
        Route::post('diagnosticos/store','DiagnosticoController@store')->name('diagnosticos.store')->middleware('permission:diagnosticos.create');

        Route::get('diagnosticos/{diagnostico}/edit','DiagnosticoController@edit')->name('diagnosticos.edit')->middleware('permission:diagnosticos.edit');
        Route::put('diagnosticos/{diagnostico}','DiagnosticoController@update')->name('diagnosticos.update')->middleware('permission:diagnosticos.edit');

        Route::delete('diagnosticos/{diagnostico}/delete','DiagnosticoController@destroy')->name('diagnosticos.destroy')->middleware('permission:diagnosticos.destroy');

        /**
         * Rutas para el modulo de Servicio
         */
        Route::get('servicios','ServicioController@index')->name('servicios.index')->middleware('permission:servicios.index');
        Route::get('servicios/apiServicios','ServicioController@apiServicios')->name('servicios.apiServicios')->middleware('permission:servicios.index');

        Route::get('servicios/create','ServicioController@create')->name('servicios.create')->middleware('permission:servicios.create');
        Route::post('servicios/store','ServicioController@store')->name('servicios.store')->middleware('permission:servicios.create');

        Route::get('servicios/{servicio}/edit','ServicioController@edit')->name('servicios.edit')->middleware('permission:servicios.edit');
        Route::put('servicios/{servicio}','ServicioController@update')->name('servicios.update')->middleware('permission:servicios.edit');

        Route::delete('servicios/{servicio}/delete','ServicioController@destroy')->name('servicios.destroy')->middleware('permission:servicios.destroy');

        /**
         * Rutas para el modulo de Rol
         */
        Route::get('roles','RoleController@index')->name('roles.index')->middleware('permission:roles.index');
        Route::get('roles/apiRoles','RoleController@apiRoles')->name('roles.apiRoles')->middleware('permission:roles.index');

        Route::get('roles/create','RoleController@create')->name('roles.create')->middleware('permission:roles.create');
        Route::post('roles/store','RoleController@store')->name('roles.store')->middleware('permission:roles.create');

        Route::get('roles/{role}/edit','RoleController@edit')->name('roles.edit')->middleware('permission:roles.edit');
        Route::put('roles/{role}','RoleController@update')->name('roles.update')->middleware('permission:roles.edit');

        Route::delete('roles/{role}/delete','RoleController@destroy')->name('roles.destroy')->middleware('permission:roles.destroy');

        /**
         * Rutas para el modulo de User 
         */
        Route::get('users','TecnicoController@index')->name('users.index')->middleware('permission:users.index');
        Route::get('users/apiUsers','TecnicoController@apiUsers')->name('users.apiUsers')->middleware('permission:users.index');

        Route::get('users/create','TecnicoController@create')->name('users.create')->middleware('permission:users.create');
        Route::post('users/store','TecnicoController@store')->name('users.store')->middleware('permission:users.create');

        Route::get('users/{tecnico}/edit','TecnicoController@edit')->name('users.edit')->middleware('permission:users.edit');
        Route::put('users/{tecnico}','TecnicoController@update')->name('users.update')->middleware('permission:users.edit');

        Route::delete('users/{tecnico}/delete','TecnicoController@destroy')->name('users.destroy')->middleware('permission:users.destroy');

        Route::post('users/upload','TecnicoController@upload')->name('users.upload')->middleware('permission:users.create');
    });

    /**
     * Rutas para el perfil y la actualizacion de password
     */
    Route::get('/perfil','TecnicoController@perfil')->name('users.perfil')->middleware('permission:users.perfil');
    Route::put('users/{user}/password', 'TecnicoController@updatepassword')->name('users.updatepassword')->middleware('permission:users.changepassword');

    Route::group(['prefix' => 'tickets'], function(){
        /**
         * Rutas para el modulo de Ticket
         */
        Route::get('{estado}','TicketController@index')->name('tickets.index')->middleware('permission:tickets.index');        
        Route::get('apiTickets/{tipo}/{gestion}','TicketController@apiTickets')->name('tickets.apiTickets')->middleware('permission:tickets.index');
        
        Route::get('create/{tipo}','TicketController@create')->name('tickets.create')->middleware('permission:tickets.create');
        Route::post('store','TicketController@store')->name('tickets.store')->middleware('permission:tickets.create');
        
        Route::get('{ticket}/edit','TicketController@edit')->name('tickets.edit')->middleware('permission:tickets.edit');
        Route::put('{ticket}','TicketController@update')->name('tickets.update')->middleware('permission:tickets.edit');
        
        Route::delete('{ticket}/delete','TicketController@destroy')->name('tickets.destroy')->middleware('permission:tickets.destroy');
        
        Route::get('{ticket}/imprimir','TicketController@imprimir')->name('tickets.imprimir')->middleware('permission:tickets.imprimir');
        
        Route::get('{ticket}/asignar','TicketController@asignar')->name('tickets.asignar')->middleware('permission:tickets.asignar');
        Route::post('{ticket}/asignar','TicketController@storeasignar')->name('tickets.storeasignar')->middleware('permission:tickets.asignar');

        Route::get('{ticket}/resolver','TicketController@resolver')->name('tickets.resolver');
        Route::get('{ticket}/deshacerresuelto','TicketController@deshacer')->name('tickets.undoresolver');
        

        Route::get('{ticket}/informe','TicketController@informe')->name('tickets.informe')->middleware('permission:tickets.informe');
        
    });
    
    /**
     * Rutas para los informes tecnicos
     */
    Route::group(['prefix' => 'informes'], function(){
        /**
        * Rutas para el modulo de Baja
        */
        Route::get('bajas','BajaController@index')->name('bajas.index')->middleware('permission:bajas.index');
        Route::get('bajas/apiBajas/{gestion}','BajaController@apiBajas')->name('bajas.apiBajas')->middleware('permission:bajas.index');

        Route::get('bajas/create','BajaController@create')->name('bajas.create')->middleware('permission:bajas.create');
        Route::post('bajas/store','BajaController@store')->name('bajas.store')->middleware('permission:bajas.create');

        Route::get('bajas/{baja}/edit','BajaController@edit')->name('bajas.edit')->middleware('permission:bajas.edit');
        Route::put('bajas/{baja}','BajaController@update')->name('bajas.update')->middleware('permission:bajas.edit');

        Route::delete('bajas/{baja}/delete','BajaController@destroy')->name('bajas.destroy')->middleware('permission:bajas.destroy');

        Route::get('bajas/{baja}/imprimir','BajaController@imprimir')->name('bajas.imprimir')->middleware('permission:bajas.imprimir');

        Route::get('bajas/{baja}/apartir', 'BajaController@apartir')->name('bajas.partir')->middleware('permission:bajas.create');

        Route::get('bajas/{baja}/cambiarFecha','BajaController@cambiarFecha')->name('bajas.cambiarFecha')->middleware('permission:bajas.cambiarFecha');

        Route::post('bajas/{baja}','BajaController@storeCambiarFecha')->name('bajas.storeCambiarFecha')->middleware('permission:bajas.cambiarFecha');

        /**
        * Rutas para el modulo de Reparacion
        */
        Route::get('reparacions','ReparacionController@index')->name('reparacions.index')->middleware('permission:reparacions.index');
        Route::get('reparacions/apiReparacions/{gestion}','ReparacionController@apiReparacions')->name('reparacions.apiReparacions')->middleware('permission:reparacions.index');

        Route::get('reparacions/create','ReparacionController@create')->name('reparacions.create')->middleware('permission:reparacions.create');
        Route::post('reparacions/store','ReparacionController@store')->name('reparacions.store')->middleware('permission:reparacions.create');

        Route::get('reparacions/{reparacion}/edit','ReparacionController@edit')->name('reparacions.edit')->middleware('permission:reparacions.edit');
        Route::put('reparacions/{reparacion}','ReparacionController@update')->name('reparacions.update')->middleware('permission:reparacions.edit');

        Route::delete('reparacions/{reparacion}/delete','ReparacionController@destroy')->name('reparacions.destroy')->middleware('permission:reparacions.destroy');

        Route::get('reparacions/{reparacion}/imprimir','ReparacionController@imprimir')->name('reparacions.imprimir')->middleware('permission:reparacions.imprimir');

        Route::get('reparacions/{reparacion}/apartir', 'ReparacionController@apartir')->name('reparacions.partir')->middleware('permission:reparacions.create');

        Route::get('reparacions/{reparacion}/cambiarFecha','ReparacionController@cambiarFecha')->name('reparacions.cambiarFecha')->middleware('permission:reparacions.cambiarFecha');

        Route::get('reparacions/{reparacion}/cambiarFecha','ReparacionController@cambiarFecha')->name('reparacions.cambiarFecha')->middleware('permission:reparacions.cambiarFecha');

        Route::post('reparacions/{reparacion}','ReparacionController@storeCambiarFecha')->name('reparacions.storeCambiarFecha')->middleware('permission:reparacions.cambiarFecha');

        /**
        * Rutas para el modulo de Reposicion
        */
        Route::get('reposicions','ReposicionController@index')->name('reposicions.index')->middleware('permission:reposicions.index');
        Route::get('reposicions/apiReposicions/{gestion}','ReposicionController@apiReposicions')->name('reposicions.apiReposicions')->middleware('permission:reposicions.index');

        Route::get('reposicions/create','ReposicionController@create')->name('reposicions.create')->middleware('permission:reposicions.create');
        Route::post('reposicions/store','ReposicionController@store')->name('reposicions.store')->middleware('permission:reposicions.create');

        Route::get('reposicions/{reposicion}/edit','ReposicionController@edit')->name('reposicions.edit')->middleware('permission:reposicions.edit');
        Route::put('reposicions/{reposicion}','ReposicionController@update')->name('reposicions.update')->middleware('permission:reposicions.edit');

        Route::delete('reposicions/{reposicion}/delete','ReposicionController@destroy')->name('reposicions.destroy')->middleware('permission:reposicions.destroy');

        Route::get('reposicions/{reposicion}/imprimir','ReposicionController@imprimir')->name('reposicions.imprimir')->middleware('permission:reposicions.imprimir');

        Route::get('reposicions/{reposicion}/apartir', 'ReposicionController@apartir')->name('reposicions.partir')->middleware('permission:reposicions.create');

        Route::get('reposicions/{reposicion}/cambiarFecha','ReposicionController@cambiarFecha')->name('reposicions.cambiarFecha')->middleware('permission:reposicions.cambiarFecha');

        Route::post('reposicions/{reposicion}','ReposicionController@storeCambiarFecha')->name('reposicions.storeCambiarFecha')->middleware('permission:reposicions.cambiarFecha');

        /**
        * Rutas para el modulo de Recepcion
        */
        Route::get('recepcions','RecepcionController@index')->name('recepcions.index')->middleware('permission:recepcions.index');
        Route::get('recepcions/apiRecepcions/{gestion}','RecepcionController@apiRecepcions')->name('recepcions.apiRecepcions')->middleware('permission:recepcions.index');

        Route::get('recepcions/create','RecepcionController@create')->name('recepcions.create')->middleware('permission:recepcions.create');
        Route::post('recepcions/store','RecepcionController@store')->name('recepcions.store')->middleware('permission:recepcions.create');

        Route::get('recepcions/{recepcion}/edit','RecepcionController@edit')->name('recepcions.edit')->middleware('permission:recepcions.edit');
        Route::put('recepcions/{recepcion}','RecepcionController@update')->name('recepcions.update')->middleware('permission:recepcions.edit');

        Route::delete('recepcions/{recepcion}/delete','RecepcionController@destroy')->name('recepcions.destroy')->middleware('permission:recepcions.destroy');

        Route::get('recepcions/{recepcion}/imprimir','RecepcionController@imprimir')->name('recepcions.imprimir')->middleware('permission:recepcions.imprimir');

        Route::get('recepcions/{recepcion}/apartir', 'RecepcionController@apartir')->name('recepcions.partir')->middleware('permission:recepcions.create');

        Route::get('recepcions/{recepcion}/cambiarFecha','RecepcionController@cambiarFecha')->name('recepcions.cambiarFecha')->middleware('permission:recepcions.cambiarFecha');

        Route::post('recepcions/{recepcion}','RecepcionController@storeCambiarFecha')->name('recepcions.storeCambiarFecha')->middleware('permission:recepcions.cambiarFecha');


         /**
        * Rutas para el modulo de Externo
        */
        Route::get('externos','ExternoController@index')->name('externos.index')->middleware('permission:externos.index');
        Route::get('externos/apiExternos/{gestion}','ExternoController@apiExternos')->name('externos.apiExternos')->middleware('permission:externos.index');

        Route::get('externos/create','ExternoController@create')->name('externos.create')->middleware('permission:externos.create');
        Route::post('externos/store','ExternoController@store')->name('externos.store')->middleware('permission:externos.create');

        Route::get('externos/{externo}/edit','ExternoController@edit')->name('externos.edit')->middleware('permission:externos.edit');
        Route::put('externos/{externo}','ExternoController@update')->name('externos.update')->middleware('permission:externos.edit');

        Route::delete('externos/{externo}/delete','ExternoController@destroy')->name('externos.destroy')->middleware('permission:externos.destroy');

        Route::get('externos/{externo}/imprimir','ExternoController@imprimir')->name('externos.imprimir')->middleware('permission:externos.imprimir');

    });

    Route::group(['prefix' => 'reportes'], function(){
        Route::get('estadisticos', 'ReporteController@index')->name('reportes.index')->middleware('permission:reportes.index');
        Route::post('estadisticos', 'ReporteController@index')->name('reportes.index')->middleware('permission:reportes.index');
        
        Route::get('informes', 'ReporteController@informes')->name('reportes.informes')->middleware('permission:reportes.personalizado');

        Route::get('personalizado/imprimir/{fecha1}/{fecha2}/{usuario}/{tipo}','ReporteController@imprimir_personalizado')->name('reportes.imprimir_personalizado')->middleware('permission:reportes.imprimir');
        Route::get('mensual/imprimir/{mes}/{anio}/{usuario}/{tipo}','ReporteController@imprimir_mensual')->name('reportes.imprimir_mensual')->middleware('permission:reportes.imprimir');

    });

});