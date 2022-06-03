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
use App\Http\Controllers\DashboardController;
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
    return view('/auth/login');
});

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');


//RUTAS SOLO PARA ADMINISTRADOR
Route::group(['middleware' => ['auth','validacionRol']], function () {

    // RUTAS ROLES
    Route::get('/rol', [RolController::class, 'index'])->name("rol.index");
    Route::get('/rol/listar', [RolController::class, 'listar']);
    Route::get('/rol/crear', [RolController::class, 'crear'])->name("rol.crear");
    Route::post('/rol/guardar', [RolController::class, 'save']);
    Route::get('/rol/editar/{id}', [RolController::class, 'edit']);
    Route::post('/rol/actualizar', [RolController::class, 'update']);
    Route::get('/rol/cambiar/estado/{id}/{estado}', [RolController::class, 'updateState']);

    //FIN RUTAS ROLES
    
    
    //RUTAS USUARIOS
    Route::get('/usuario/crear', [UserController::class, 'crear'])->name("usuario.crear");
    Route::post('/usuario/guardar', [UserController::class, 'save']);
    Route::get('/usuario/editar/{id}', [UserController::class, 'edit']);
    Route::post('/usuario/actualizar', [UserController::class, 'update']);
    Route::get('/usuario/cambiar/estado/{id}/{estado}', [UserController::class, 'updateState']);
    //FIN RUTAS USUARIOS
    
    
    //RUTAS CATEGORIAS
    Route::get('/categoria/crear', [CategoriaController::class, 'crear'])->name("categoria.crear");
    Route::post('/categoria/guardar', [CategoriaController::class, 'save']);
    Route::get('/categoria/editar/{id}', [CategoriaController::class, 'edit']);
    Route::post('/categoria/actualizar', [CategoriaController::class, 'update']);
    Route::get('/categoria/cambiar/estado/{id}/{estado}', [CategoriaController::class, 'updateState']);
    //FIN RUTAS CATEGORIAS
    
    
    //RUTAS PRODUCTOS
    Route::get('/producto/crear', [ProductoController::class, 'crear'])->name("producto.crear");
    Route::post('/producto/guardar', [ProductoController::class, 'save']);
    Route::get('/producto/editar/{id}', [ProductoController::class, 'edit']);
    Route::post('/producto/actualizar/{id}', [ProductoController::class, 'update'])->name("producto.actualizar");
    //FIN RUTAS PRODUCTOS
    
    
    //RUTAS PROVEEDORES
    Route::get('/proveedor', [ProveedorController::class, 'index'])->name("proveedor.index");
    Route::get('/proveedor/listar', [ProveedorController::class, 'listar']);
    Route::get('/proveedor/crear', [ProveedorController::class, 'crear'])->name("proveedor.crear");
    Route::post('/proveedor/guardar', [ProveedorController::class, 'save']);
    Route::get('/proveedor/editar/{id}', [ProveedorController::class, 'edit']);
    Route::post('/proveedor/actualizar/{id}', [ProveedorController::class, 'update'])->name("proveedor.actualizar");
    Route::get('/proveedor/cambiar/estado/{id}/{estado}', [ProveedorController::class, 'updateState']);
    Route::get('/proveedor/detalle/{id}', [ProveedorController::class, 'detalle'])->name('proveedor.detalle');
    //FIN RUTAS PROVEEDORES
    
    //RUTAS COPMRAS
    Route::get('/compra/cambiar/estado/{idCompra}/{estado}', [ComprasController::class, 'updateState']);
    //FIN RUTAS COPMRAS
    
    
    //RUTAS VENTAS
    Route::get('/ventas/cambiarEstado/{id}/{Estado}', [VentasController::class, 'updateState'])->name('ventas.cambiar');
    //FIN RUTAS VENTAS
    
    });
    
    //RUTAS PARA TODOS LOS USUARIOS
    Route::group(['middleware' => ['auth']], function () {
    
    
    //RUTAS USUARIOS
    Route::get('/usuario', [UserController::class, 'index'])->name("usuario.index");
    Route::get('/usuario/listar', [UserController::class, 'listar']);
    Route::get('/usuario/editarEmpleado/{id}', [UserController::class, 'editEmpl']);
    Route::post('/usuario/actualizarEmpleado', [UserController::class, 'updateEmpl']);
    Route::get('/usuario/detalle/{id}', [UserController::class, 'detalle']);
    //FIN RUTAS USUARIOS
    
    //RUTAS CATEGORIAS
    Route::get('/categoria', [CategoriaController::class, 'index'])->name("categoria.index");
    Route::get('/categoria/listar', [CategoriaController::class, 'listar']);
    //FIN RUTAS CATEGORIAS
    
    //RUTAS PRODUCTOS
    Route::get('/producto', [ProductoController::class, 'index'])->name("producto.index");
    Route::get('/producto/listar', [ProductoController::class, 'listar']);
    Route::get('/producto/cambiar/estado/{id}/{estado}', [ProductoController::class, 'updateState']);
    //FIN RUTAS PRODUCTOS
    
    //RUTAS COPMRAS
    Route::get('/compra', [ComprasController::class, 'index'])->name("compra.index");
    Route::get('/compra/listar', [ComprasController::class, 'listar']);
    Route::get('/compra/crear', [ComprasController::class, 'crear'])->name("compra.crear");
    // Route::get('/compra/obtenerPrecio/{id}', [ComprasController::class, 'obtener_Precio']);
    Route::post('/compra/guardar', [ComprasController::class, 'save']);
    Route::get('/compra/detalle/{id}', [ComprasController::class, 'detalle']);
    //FIN RUTAS COPMRAS
    
    //RUTAS CLIENTES
    
    Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/listar', [ClientesController::class, 'listar'])->name('clientes.datatable');
    Route::get('/clientes/crear', [ClientesController::class, 'crear'])->middleware('auth')->name('clientes.crear');
    Route::post('/clientes/guardar', [ClientesController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/editar/{id}', [ClientesController::class, 'editar'])->name('clientes.editar');
    Route::post('/clientes/actualizar/{id}', [ClientesController::class, 'update'])->name('clientes.actualizar');
    Route::get('/clientes/detalle/{id}', [ClientesController::class, 'detalle'])->name('clientes.detalle');
    //FIN RUTAS CLIENTES
    
    //RUTAS VENTAS
    Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.index');
    Route::get('/ventas/listar', [VentasController::class, 'listar']);
    Route::get('/ventas/crear', [VentasController::class, 'crear'])->name('ventas.crear');
    Route::post('/ventas/guardar', [VentasController::class, 'store'])->name('ventas.store');
    Route::get('/ventas/verproductos/{id}', [VentasController::class, 'listardetalle'])->name('ventas.detalle');
    //FIN RUTAS VENTAS
     //RUTAS DASHBOARD
     Route::get('/dashboard', [DashboardController::class, 'index'])->name("dashboard.index");
     //FIN RUTAS DASHBOARD
    });
