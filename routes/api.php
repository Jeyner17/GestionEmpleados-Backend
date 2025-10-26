<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProvinciaController;
use App\Http\Controllers\Api\EmpleadoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas de Provincias
Route::prefix('provincias')->group(function () {
    Route::get('/', [ProvinciaController::class, 'index']);
    Route::get('/{id}', [ProvinciaController::class, 'show']);
});

// Rutas de Empleados
Route::prefix('empleados')->group(function () {
    Route::get('/', [EmpleadoController::class, 'index']);
    Route::post('/', [EmpleadoController::class, 'store']);
    Route::get('/reporte', [EmpleadoController::class, 'reporte']);
    Route::get('/{id}', [EmpleadoController::class, 'show']);
    Route::put('/{id}', [EmpleadoController::class, 'update']);
    Route::post('/{id}', [EmpleadoController::class, 'update']); 
    Route::delete('/{id}', [EmpleadoController::class, 'destroy']);
});