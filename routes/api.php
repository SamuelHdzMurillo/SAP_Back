<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\PromotorController;
use App\Http\Controllers\PromotedController;
use App\Http\Controllers\MunicipalController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\Auth\SuperAdminAuthController;
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

Route::post('/login', [SuperAdminAuthController::class, 'login']);
Route::post('/logout', [SuperAdminAuthController::class, 'logout'])->middleware('auth:superadmin');

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
Route::get('/promotor/{promotorId}/promoteds', [PromotorController::class, 'showPromoteds']);
Route::get('/promotor/{promotorId}/promoteds/count', [PromotorController::class, 'showPromotedsCount']);


Route::get('/promoted', [PromotedController::class, 'index']);
Route::post('/promoted', [PromotedController::class, 'store']);
Route::get('/promoted/{id}', [PromotedController::class, 'show']);
Route::put('/promoted/{id}', [PromotedController::class, 'update']);
Route::delete('/promoted/{id}', [PromotedController::class, 'destroy']);




Route::post('/upload-excel/{promotorId}', [PromotedController::class, 'uploadExcel']);
Route::get('/export-excel', [PromotedController::class, 'export']);

Route::get('/municipals', [MunicipalController::class, 'index']);
Route::get('/municipals/{municipalId}/districts/{districtId}/promoveds/count', [MunicipalController::class, 'countPromovedsInDistrict']);
Route::get('/municipals/districts/promoveds/count', [MunicipalController::class, 'countPromovedsInAll']);
Route::get('/municipals/sections/promoveds/count', [MunicipalController::class, 'countPromovedsInSections']);
Route::get('/municipals/sections/promoveds/count-by-date', [MunicipalController::class, 'countPromovedsInSectionsByDate']);
Route::get('/municipals/districts/promoveds/count-by-date', [MunicipalController::class, 'countPromovedsInDistrictsByDate']);
Route::get('/municipals/sections-with-promoved-count', [MunicipalController::class, 'sectionsWithPromovedCount']);


Route::get('/districts/{id}', [DistrictController::class, 'show']);


Route::get('/problems', [ProblemController::class, 'index']); // Listar todos los problemas
Route::post('/problems', [ProblemController::class, 'store']); // Crear un nuevo problema
Route::get('/problems/{problem}', [ProblemController::class, 'show']); // Mostrar un problema específico
Route::put('/problems/{problem}', [ProblemController::class, 'update']); // Actualizar un problema
Route::delete('/problems/{problem}', [ProblemController::class, 'destroy']); // Eliminar un problema



Route::get('/catalog/municipal', [CatalogController::class, 'MunicipalSelect']);
Route::get('/municipals/{municipalId}/districts', [CatalogController::class, 'getDistrictsByMunicipal']);
Route::get('/districts/{districtId}/sections', [CatalogController::class, 'getSectionsByDistrict']);
