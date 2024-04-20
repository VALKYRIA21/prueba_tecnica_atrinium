<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\UserApiController;
use App\Http\Controllers\Api\V1\EmpresaApiController;

Route::prefix('v1')->group(function () {

    // User routes

    // Ruta para test
    Route::get('/test_user', [UserApiController::class, 'index']);
    // Ruta para mostrar todos los usuarios
    Route::get('/users', [UserApiController::class, 'show']);
    // Ruta para mostrar un usuario en espeficico
    Route::get('/users/{id}', [UserApiController::class, 'showUser']);
    // Ruta para almacenar un nuevo usuario
    Route::post('/create/users', [UserApiController::class, 'store']);
    // Ruta para actualizar un usuario
    Route::put('/update/users/{id}', [UserApiController::class, 'update']);
    // Ruta para eliminar un usuario
    Route::delete('/delete/users/{id}', [UserApiController::class, 'destroy']);
    // Ruta para cambiar el rol de un usuario basico a admin
    Route::put('/change/role/users/{id}', [UserApiController::class, 'changeRole']);

    // Empresa routes
    // Ruta para test
    Route::get('/test_empresa', [EmpresaApiController::class, 'index']);
    // Ruta para mostrar todas las empresas
    Route::get('/empresas', [EmpresaApiController::class, 'show']);
    // Ruta para mostrar una empresa en especifico
    Route::get('/empresas/{id}', [EmpresaApiController::class, 'showEmpresa']);
    // Ruta para almacenar una nueva empresa
    Route::post('/create/empresa', [EmpresaApiController::class, 'store']);
    // Ruta para actualizar una empresa
    Route::put('/update/empresas/{id}', [EmpresaApiController::class, 'update']);
    // Ruta para eliminar una empresa
    Route::delete('/delete/empresas/{id}', [EmpresaApiController::class, 'destroy']);

    // Actividad Empresa routes
    // Ruta para test
    Route::get('/test_actividad_empresa', [ActividadEmpresaApiController::class, 'index']);
});
