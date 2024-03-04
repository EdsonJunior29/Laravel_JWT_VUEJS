<?php

use App\Http\Controllers\CarroController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LocacaoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
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

Route::prefix('marca')->group(function () {
    Route::get('', [MarcaController::class, 'index']);
    Route::get('/{id}', [MarcaController::class, 'show']);
    Route::post('', [MarcaController::class, 'store']);
    Route::put('/{id}', [MarcaController::class, 'update']);
    Route::delete('/{id}', [MarcaController::class, 'destroy']);
});

Route::apiResource('carro', CarroController::class);
Route::apiResource('cliente', ClienteController::class);
Route::apiResource('locacao', LocacaoController::class);
Route::apiResource('modelo', ModeloController::class);
