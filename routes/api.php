<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\PromotorController;
use App\Http\Controllers\PromotedController;
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

Route::get('/superAdmins', [SuperAdminController::class, 'index']);
Route::post('/superAdmins', [SuperAdminController::class, 'store']);
Route::get('/superAdmins/{superAdmin}', [SuperAdminController::class, 'show']);
Route::put('/superAdmins/{superAdmin}', [SuperAdminController::class, 'update']);
Route::delete('/superAdmins/{superAdmin}', [SuperAdminController::class, 'destroy']);

Route::get('/promotores', [PromotorController::class, 'index']);
Route::post('/promotores', [PromotorController::class, 'store']);
Route::get('/promotores/{promotor}', [PromotorController::class, 'show']);
Route::put('/promotores/{promotor}', [PromotorController::class, 'update']);
Route::delete('/promotores/{promotor}', [PromotorController::class, 'destroy']);


Route::get('/promoted', [PromotedController::class, 'index']);
Route::post('/promoted', [PromotedController::class, 'store']);
Route::get('/promoted/{id}', [PromotedController::class, 'show']);
Route::put('/promoted/{id}', [PromotedController::class, 'update']);
Route::delete('/promoted/{id}', [PromotedController::class, 'destroy']);


