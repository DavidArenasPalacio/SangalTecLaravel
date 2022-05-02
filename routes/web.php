<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ControlExistenciaController;
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
    return view('home');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/rol', [RolController::class, 'index'])->name("rol.index");
Route::get('/rol/listar', [RolController::class, 'listar']);
Route::get('/rol/crear', [RolController::class, 'create'])->name("rol.create");
Route::post('/rol/guardar', [RolController::class, 'save']);
Route::get('/rol/editar/{id}', [RolController::class, 'edit']);
Route::post('/rol/actualizar', [RolController::class, 'update']);

Route::get('/usuario', [UserController::class, 'index'])->name("usuario.index");
Route::get('/usuario/listar', [UserController::class, 'listar']);
Route::get('/usuario/crear/', [UserController::class, 'create'])->name("usuario.create");
Route::post('/usuario/guardar', [UserController::class, 'save']);
Route::get('/usuario/editar/{id}', [UserController::class, 'edit']);
Route::post('/usuario/actualizar', [UserController::class, 'update']);
Route::get('/usuario/cambiar/estado/{id}/{estado}', [UserController::class, 'updateState']);

Route::get('/categoria', [CategoriaController::class, 'index'])->name('categoria.index');
Route::get('/categoria/listar', [CategoriaController::class, 'listar']);
Route::get('/categoria/crear', [CategoriaController::class, 'create'])->name('categoria.create');
Route::post('/categoria/guardar', [CategoriaController::class, 'save']);
Route::get('/categoria/editar/{id}', [CategoriaController::class, 'edit']);
Route::get('/categoria/eliminar/{id}', [CategoriaController::class, 'delete']);
Route::post('/categoria/actualizar', [CategoriaController::class, 'update']);
Route::get('/categoria/cambiar/estado/{idCategoria}/{estado}', [CategoriaController::class, 'updateState']);

Route::get('/producto', [ProductoController::class, 'index'])->name('producto.index');
Route::get('/producto/listar', [ProductoController::class, 'listar']);
Route::get('/producto/crear', [ProductoController::class, 'create'])->name('producto.create');
Route::post('/producto/guardar', [ProductoController::class, 'save']);
Route::get('/producto/editar/{id}', [ProductoController::class, 'edit']);
Route::post('/producto/actualizar', [ProductoController::class, 'update']);
Route::get('/producto/cambiar/estado/{id}/{estado}', [ProductoController::class, 'updateState']);

Route::get('/compra', [ComprasController::class, 'index'])->name('compra.index');
Route::get('/compra/listar', [ComprasController::class, 'listar'])->name('compra.create');
Route::post('/compra/guardar', [ComprasController::class, 'save']);
Route::get('/compra/detalle/{id}', [ComprasController::class, 'detalle']);
Route::get('/compra/cambiar/estado/{idCompra}/{estado}', [ComprasController::class, 'updateState']);

Route::get('/proveedor', [ProveedorController::class, 'index'])->name('proveedor.index');
Route::get('/proveedor/listar', [ProveedorController::class, 'listar']);
Route::get('/proveedor/crear', [ProveedorController::class, 'create'])->name('proveedor.create');
Route::post('/proveedor/guardar', [ProveedorController::class, 'save']);
Route::get('/proveedor/editar/{id}', [ProveedorController::class, 'edit']);
Route::post('/proveedor/actualizar', [ProveedorController::class, 'update']);
Route::get('/proveedor/cambiar/estado/{id}/{estado}', [ProveedorController::class, 'updateState']);
Route::get('/proveedor/detalle/{id}', [ProveedorController::class, 'detalle'])->name('proveedor.detalle')->middleware('auth');

Route::get('/clientes', [ClientesController::class, 'index'])->middleware('auth');
Route::get('/clientes/listar', [ClientesController::class, 'listar'])->name('clientes.datatable')->middleware('auth');
Route::get('/clientes/crear', [ClientesController::class, 'crear'])->middleware('auth');
Route::post('/clientes/guardar', [ClientesController::class, 'store'])->name('clientes.store')->middleware('auth');
Route::get('/clientes/editar/{id}', [ClientesController::class, 'editar'])->name('clientes.editar')->middleware('auth');
Route::post('/clientes/actualizar/{id}', [ClientesController::class, 'update'])->name('clientes.actualizar')->middleware('auth');
Route::get('/clientes/detalle/{id}', [ClientesController::class, 'detalle'])->name('clientes.detalle')->middleware('auth');

Route::get('/ventas', [VentasController::class, 'index'])->middleware('auth');
Route::get('/ventas/listar', [VentasController::class, 'listar'])->middleware('auth');
Route::get('/ventas/crear', [VentasController::class, 'crear'])->middleware('auth');
Route::post('/ventas/guardar', [VentasController::class, 'store'])->name('ventas.store')->middleware('auth');
Route::get('/ventas/verproductos/{id}', [VentasController::class, 'listardetalle'])->name('ventas.detalle')->middleware('auth');
Route::get('/ventas/cambiarEstado/{id}/{Estado}', [VentasController::class, 'updateState'])->name('ventas.cambiar')->middleware('auth');
