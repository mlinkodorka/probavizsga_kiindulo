<?php

use App\Http\Controllers\SzakdogaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|---------------------------------------------------------------------------
| API Routes
|---------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/szakdogak', [SzakdogaController::class, 'index']);  // Szakdolgozatok lekérése
Route::post('/szakdogak', [SzakdogaController::class, 'store']); // Új szakdoga hozzáadása
Route::put('/szakdogak/{id}', [SzakdogaController::class, 'update']);  // Szakdoga módosítása
Route::delete('/szakdogak/{id}', [SzakdogaController::class, 'destroy']);  // Szakdoga törlése
