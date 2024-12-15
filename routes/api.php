<?php

use App\Http\Controllers\SzakdogaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/szakdogak', [SzakdogaController::class, 'index']);
    Route::post('/szakdogak', [SzakdogaController::class, 'store']);
    Route::put('/szakdogak/{id}', [SzakdogaController::class, 'update']);
    Route::delete('/szakdogak/{id}', [SzakdogaController::class, 'destroy']);
});