<?php

use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\PatientController;
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
Route::prefix('auth')->group(function () {
    Route::post('login', [ApiAuthController::class, 'login']);
    Route::post('login-PGCT', [ApiAuthController::class, 'loginPGCT']);
});
Route::middleware('auth:patient-api')->group(function () {
    Route::get('cities', [CityController::class, 'index']);
});
Route::prefix('auth')->middleware('auth:patient-api')->group(function () {
    Route::get('logout', [ApiAuthController::class, 'Logout']);
});
