<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ColorSchemeController;


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

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');

Route::controller(AuthController::class)->middleware('loggedin')->group(function() {
    Route::get('login', 'loginView')->name('login.index');
    Route::post('login', 'login')->name('login.check');
    Route::get('/', 'loginView')->name('login.index');
});

Route::group(['middleware' => ['auth'], 'namespace' => 'CoreControllers'], function(){


    Route::post('files/store', 'FileController@store')->name('file.store');

    Route::post('files/remove', 'FileController@remvoeFile')->name('file.remove');

});
Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'namespace' => 'AdminControllers'], function(){

    Route::get('/dashboard-admin', 'DashboardController@dashboardAdmin')->name('dashboard-admin');
    Route::get('/paises-display', 'PaisesController@display')->name('paises-display');
    Route::get('/paises-add', 'PaisesController@add')->name('paises-add');
    Route::post('/paises-insert', 'PaisesController@insert')->name('paises-insert');
    Route::get('/paises-list', 'PaisesController@list')->name('paises-add');
    Route::get('/paises-edit/{id}', 'PaisesController@edit')->name('paises-edit');
    Route::post('/paises-update', 'PaisesController@update')->name('paises-update');
    Route::post('/paises-delete', 'PaisesController@delete')->name('paises-delete');

    Route::get('/regiones-display', 'RegionesController@display')->name('regiones-display');
    Route::get('/regiones-add', 'RegionesController@add')->name('regiones-add');
    Route::post('/regiones-insert', 'RegionesController@insert')->name('regiones-insert');
    Route::get('/regiones-list', 'RegionesController@list')->name('regiones-add');
    Route::get('/regiones-edit/{id}', 'RegionesController@edit')->name('regiones-edit');
    Route::post('/regiones-update', 'RegionesController@update')->name('regiones-update');
    Route::post('/regiones-delete', 'RegionesController@delete')->name('regiones-delete');


    Route::get('/usuarios-display', 'UsuariosController@display')->name('usuarios-display');
    Route::get('/usuarios-add', 'UsuariosController@add')->name('usuarios-add');
    Route::post('/usuarios-insert', 'UsuariosController@insert')->name('usuarios-insert');
    Route::get('/usuarios-list', 'UsuariosController@list')->name('usuarios-add');
    Route::get('/usuarios-edit/{id}', 'UsuariosController@edit')->name('usuarios-edit');
    Route::post('/usuarios-update', 'UsuariosController@update')->name('usuarios-update');
    Route::get('/usuarios-clave/{id}', 'UsuariosController@reiniciar_clave')->name('usuarios-clave');
    Route::post('/usuarios-delete', 'UsuariosController@delete')->name('usuarios-delete');

    Route::get('/data-add', 'DataController@import_form')->name('data-add');
    //Route::post('/data-import', 'DataController@import')->name('data-import');
    Route::post('/data-import', 'DataController@import_sheet')->name('data-import');


    Route::get('/proveedores-display', 'ProveedoresController@display')->name('proveedores-display');
    Route::get('/proveedores-add', 'ProveedoresController@add')->name('proveedores-add');
    Route::post('/proveedores-insert', 'ProveedoresController@insert')->name('proveedores-insert');
    Route::get('/proveedores-list', 'ProveedoresController@list')->name('proveedores-add');
    Route::get('/proveedores-edit/{id}', 'ProveedoresController@edit')->name('proveedores-edit');
    Route::post('/proveedores-update', 'ProveedoresController@update')->name('proveedores-update');
    Route::post('/proveedores-delete', 'ProveedoresController@delete')->name('proveedores-delete');

});

Route::group(['prefix' => 'usuario', 'middleware' => ['auth'], 'namespace' => 'UsuarioControllers'], function(){

    Route::get('/select-country', 'DashboardController@selectCountry')->name('select-country');
    Route::post('/selected-country', 'DashboardController@selectedCountry')->name('selected-country');
    Route::post('/send-request', 'DashboardController@sendRequest')->name('send-request');
    Route::get('/change-country/{pais}', 'DashboardController@changeCountry')->name('selected-country');
    Route::post('/check-country', 'DashboardController@checkCountry')->name('check-country');
    Route::get('/dashboard-usuario', 'DashboardController@dashboardOverview1')->name('dashboard-usuario');
    Route::get('/dashboard-demografico', 'DashboardController@dashboardDemografico')->name('dashboard-demografico');
    Route::get('/mercado-harinas', 'DashboardController@mercadoHarinas')->name('mercado-harinas');
    Route::get('/valoracion-mercado', 'DashboardController@valoracionMercado')->name('valoracion-mercado');
    Route::get('/redes-sociales', 'DashboardController@redesSociales')->name('redes-sociales');
    Route::get('/conexion-latina', 'DashboardController@conexionLatina')->name('conexion-latina');
    Route::get('/estudios-adhoc', 'DashboardController@estudiosAdhoc')->name('estudios-adhoc');
    Route::get('/global-analisis', 'DashboardController@globalAnalisis')->name('global-analisis');
    Route::get('/global-analisis/{year}', 'DashboardController@globalAnalisis')->name('global-analisis');
    Route::get('/global-investigacion', 'DashboardController@globalInvestigacion')->name('global-investigacion');
    Route::get('/global-investigacion/{year}', 'DashboardController@globalInvestigacion')->name('global-investigacion');
    Route::get('/panel-hogares', 'DashboardController@panelHogares')->name('panel-hogares');
    Route::get('/valoracion-marca', 'DashboardController@valoracionMarca')->name('valoracion-marca');
    Route::get('/valoracion-marca/{marca}', 'DashboardController@valoracionMarca')->name('valoracion-marca');
    Route::get('/analisis-mercado-clientes', 'DashboardController@analisisMercadoClientes')->name('analisis-mercado-clientes');
    Route::get('/segmentaciones', 'DashboardController@segmentaciones')->name('segmentaciones');
    Route::get('/proveedores', 'DashboardController@proveedores')->name('proveedores');
    Route::get('/tendencias', 'DashboardController@tendencias')->name('tendencias');
    Route::get('/ventas', 'DashboardController@ventas_new')->name('ventas');
    Route::get('/analisis-otros', 'DashboardController@analisisOtros')->name('analisis-otros');
    Route::get('/investigacion-otros', 'DashboardController@investigacionOtros')->name('investigacion-otros');
    Route::get('/ventas-otros', 'DashboardController@ventasOtros')->name('ventas-otros');
    Route::get('/cambiar-clave', 'DashboardController@cambiarClave')->name('cambiar-clave');
    Route::post('/clave-change', 'DashboardController@claveChange')->name('clave-change');
    Route::get('/list-ventas-regiones', 'DashboardController@lisventasregiones')->name('list-ventas-regiones');
    Route::get('/ventas-new', 'DashboardController@ventas_new')->name('ventas-new');


    Route::post('/filtro-investigacion-global', 'DashboardController@filtroInvestigacionGlobal')->name('filtro-investigacion-global');
    Route::post('/panel-hogares-filtro', 'DashboardController@filtroPanelHogares')->name('panel-hogares-filtro');
    Route::post('/investigacion-otros-filtro', 'DashboardController@filtroInvestigacionOtros')->name('investigacion-otros-filtro');

    Route::post('/filtro-analisis-global', 'DashboardController@filtroAnalisisGlobal')->name('filtro-analisis-global');
    Route::post('/filtro-valoracion-marca', 'DashboardController@filtroValoracionMarca')->name('filtro-valoracion-marca');
    Route::post('/filtro-redes-sociales', 'DashboardController@filtroRedesSociales')->name('filtro-redes-sociales');
    Route::post('/filtro-clientes', 'DashboardController@filtroClientes')->name('filtro-clientes');
    Route::post('/filtro-segmentaciones', 'DashboardController@filtroSegmentaciones')->name('filtro-segmentaciones');

    Route::post('/analisis-otros-filtro', 'DashboardController@filtroAnalisisOtros')->name('analisis-otros-filtro');
    Route::post('/filtro-proveedores', 'DashboardController@filtroInformacionSindicada')->name('filtro-proveedores');
    Route::post('/filtro-ventas', 'DashboardController@filtroVentas')->name('filtro-ventas');
    Route::post('/filtro-ventas-otros', 'DashboardController@filtroVentasOtros')->name('filtro-ventas-otros');

    Route::post('/filtro-adhoc-marca-categoria-1', 'DashboardController@filtroCategoria1')->name('filtro-adhoc-marca-categoria-1');
    Route::post('/filtro-adhoc-marca-categoria-2', 'DashboardController@filtroCategoria2')->name('filtro-adhoc-marca-categoria-2');
    Route::post('/filtro-adhoc-cliente-1', 'DashboardController@filtroCliente1')->name('filtro-adhoc-cliente-1');
    Route::post('/filtro-adhoc-cliente-2', 'DashboardController@filtroCliente2')->name('filtro-adhoc-cliente-2');
    Route::post('/filtro-ventas-hpm', 'DashboardController@filtroVentasHpm')->name('filtro-ventas-hpm');
    Route::get('/precios', 'DashboardController@precios')->name('precios');
    Route::post('/filtro-precios', 'DashboardController@filtroPrecios')->name('filtro-precios');
    Route::post('/filtro-precio-maiz', 'DashboardController@filtroPrecioMaiz')->name('filtro-precio-maiz');
    Route::post('/filtro-precio-comodities', 'DashboardController@filtroComodities')->name('filtro-precio-comodities');

    Route::post('/grafico-kpi', 'DashboardController@graficoKpi')->name('grafico-kpi');



});

Route::middleware('auth')->group(function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
