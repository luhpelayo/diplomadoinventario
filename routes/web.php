<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\NotaCompraController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\NotaVentaController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\AutoController;
use App\Http\Controllers\DetalleCompraController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\CompatibilidadController;
use App\Http\Controllers\CuotaController;
use App\Http\Controllers\ReciboPagoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PlanPagoController;
use App\Http\Controllers\ResultadoController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\ReporteController;
use App\Models\NotaCompra;

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

//proveedor
Route::get('/proveedores', [ProveedorController::class, 'indexProveedor'])->name('proveedores.indexProveedor');
Route::get('/proveedores/create', [ProveedorController::class, 'createProveedor'])->name('proveedores.createProveedor');
Route::post('/proveedores', [ProveedorController::class, 'storeProveedor'])->name('proveedores.storeProveedor');
Route::get('/proveedores/{proveedore}', [ProveedorController::class, 'showProveedor'])->name('proveedores.showProveedor');
Route::get('/proveedores/{proveedore}/edit', [ProveedorController::class, 'editProveedor'])->name('proveedores.editProveedor');
Route::put('/proveedores/{proveedore}', [ProveedorController::class, 'updateProveedor'])->name('proveedores.updateProveedor');
Route::delete('/proveedores/{proveedore}', [ProveedorController::class, 'destroyProveedor'])->name('proveedores.destroyProveedor');

//Nota de Compra
Route::get('/notaCompras', [NotaCompraController::class, 'indexNotacompra'])->name('notaCompras.indexNotacompra');
Route::get('/notaCompras/create', [NotaCompraController::class, 'createNotacompra'])->name('notaCompras.createNotacompra');
Route::post('/notaCompras', [NotaCompraController::class, 'storeNotacompra'])->name('notaCompras.storeNotacompra');
Route::get('/notaCompras/{notaCompra}', [NotaCompraController::class, 'showNotacompra'])->name('notaCompras.showNotacompra');
Route::get('/notaCompras/{notaCompra}/edit', [NotaCompraController::class, 'editNotacompra'])->name('notaCompras.editNotacompra');
Route::put('/notaCompras/{notaCompra}', [NotaCompraController::class, 'updateNotacompra'])->name('notaCompras.updateNotacompra');
Route::delete('/notaCompras/{notaCompra}', [NotaCompraController::class, 'destroyNotacompra'])->name('notaCompras.destroyNotacompra');

//Detalle compra
Route::prefix('detalle-compra')->group(function () {
    Route::get('/', [DetalleCompraController::class, 'indexDetallecompra'])->name('detalleCompras.indexDetallecompra');
    Route::get('/{id}/show', [DetalleCompraController::class, 'showDetallecompra'])->name('detalleCompras.showDetallecompra');
    Route::get('/{notaCompra}/create', [DetalleCompraController::class, 'createDetallecompra'])->name('detalleCompras.createDetallecompra');
    Route::post('/', [DetalleCompraController::class, 'storeDetallecompra'])->name('detalleCompras.storeDetallecompra');
    Route::delete('/{id}', [DetalleCompraController::class, 'destroyDetallecompra'])->name('detalleCompras.destroyDetallecompra');
});


Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users',UserController::class);

Route::resource('roles', RoleController::class)->names('admin.roles');

Route::resource('clientes',ClienteController::class);

Route::resource('personales',PersonalController::class);

Route::resource('productos',ProductoController::class);

Route::resource('categorias',CategoriaController::class);

Route::resource('bitacora',BitacoraController::class);



Route::resource('marcas',MarcaController::class);

Route::resource('notaVentas',NotaVentaController::class);

Route::resource('detalleVentas',DetalleVentaController::class);

//Route::resource('marcas',MarcaController::class); poner solo si esta hecho

Route::resource('autos',AutoController::class);


Route::resource('facturas',FacturaController::class);

Route::get('facturaCreate/{notaVenta}',[FacturaController::class,'create2'])->name('facturaCreate');
Route::resource('compatibilidades',CompatibilidadController::class);

Route::resource('salidas', SalidaController::class)->names('salidas');

//Route::resource('resultados', ResultadoController::class)->names('resultados');

Route::resource('planPagos', PlanPagoController::class)->names('planPagos');
Route::get('planPagoCreate/{notaVenta}', [PlanPagoController::class, 'create2'])->name('planPagoCreate');

Route::resource('cuotas', CuotaController::class)->names('cuotas');
Route::get('cuotaCreate/{planPago}', [CuotaController::class, 'create2'])->name('cuotaCreate');


Route::resource('reciboPagos', ReciboPagoController::class)->names('reciboPagos');
Route::get('reciboPagosCrear/{cuota}', [ReciboPagoController::class, 'create2'])->name('reciboPagosCrear');




Route::get('reporte_date',[ReporteController::class,'reporte_fecha'])->name('reporte.date');
Route::post('reporte_resultados',[ReporteController::class,'reporte_resultado'])->name('reporte.resultados');

Route::get('reporteCompra_date',[ReporteController::class,'reporteCompra_fecha'])->name('reporteCompra.date');
Route::post('reporteCompra_resultados',[ReporteController::class,'reporteCompra_resultado'])->name('reporteCompra.resultados');


