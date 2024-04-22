<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\UserApiController;
use App\Http\Controllers\Api\V1\EmpresaApiController;
use App\Http\Controllers\Api\V1\ActividadEmpresaApiController;
use App\Http\Controllers\Api\V1\HistorialConversionApiController;


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
    // Ruta para filtrar (Encontrar usuarios que sean propietarios de empresas)
    Route::get('/filter/users/empresa', [UserApiController::class, 'findUsersEmpresa']);

    // ----------------------------------------------------------------------------------------------------------

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
    // Ruta para filtrar (Encontrar empresas que no tengan actividades)
    Route::get('/filter/empresas/actividades', [EmpresaApiController::class, 'findEmpresasSinActividades']);

    // ----------------------------------------------------------------------------------------------------------

    // Actividad Empresa routes
    // Ruta para test
    Route::get('/test_actividad_empresa', [ActividadEmpresaApiController::class, 'index']);
    // Ruta para mostrar todas las actividades de las empresas
    Route::get('/actividades_empresas', [ActividadEmpresaApiController::class, 'show']);
    // Ruta para mostrar una actividad de una empresa en especifico
    Route::get('/actividades_empresas/{id}', [ActividadEmpresaApiController::class, 'showActividadEmpresa']);
    // Ruta para almacenar una nueva actividad de una empresa
    Route::post('/create/actividad_empresa', [ActividadEmpresaApiController::class, 'store']);
    // Ruta para actualizar una actividad de una empresa
    Route::put('/update/actividades_empresas/{id}', [ActividadEmpresaApiController::class, 'update']);
    // Ruta para eliminar una actividad de una empresa
    Route::delete('/delete/actividades_empresas/{id}', [ActividadEmpresaApiController::class, 'destroy']);

    // ----------------------------------------------------------------------------------------------------------

    // Filtro
    // Filtrar encontrar coincidencias de texto en los listados de usuarios, empresas y actividades por al menos 3 atributos de cada modelo.
    Route::post('/filter/coincidencias', [EmpresaApiController::class, 'findCoincidencias']);

    // ----------------------------------------------------------------------------------------------------------

    // Historial Conversion routes
    // Ruta para test
    Route::get('/test_historial_conversion', [HistorialConversionApiController::class, 'index']);
    // Ruta para mostrar todos los historiales de conversion
    Route::get('/historial_conversion', [HistorialConversionApiController::class, 'showAll']);
    // Ruta para almacenar un nuevo historial de conversion
    Route::post('/create/historial_conversion', [HistorialConversionApiController::class, 'store']);

});
