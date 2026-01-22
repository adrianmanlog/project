<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CamionController;
use App\Http\Controllers\Api\RepuestoController;
use App\Http\Controllers\Api\ServicioController;
use App\Http\Controllers\Api\ReparacionController;

// Rutas API para camiones
Route::apiResource('camiones', CamionController::class);

// Rutas API para repuestos
Route::apiResource('repuestos', RepuestoController::class);
Route::patch('repuestos/{id}/stock', [RepuestoController::class, 'actualizarStock']);

// Rutas API para servicios
Route::apiResource('servicios', ServicioController::class);

// Rutas API para reparaciones
Route::apiResource('reparaciones', ReparacionController::class);
Route::post('reparaciones/{id}/repuestos', [ReparacionController::class, 'agregarRepuestos']);
Route::patch('reparaciones/{id}/estado', [ReparacionController::class, 'actualizarEstado']);
