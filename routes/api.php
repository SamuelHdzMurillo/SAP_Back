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
use App\Http\Controllers\GoalController;
use App\Http\Controllers\Auth\SuperAdminAuthController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\GoalDistrictController;

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
Route::post('/logout', [SuperAdminAuthController::class, 'logout']);

Route::get('/goals', [GoalController::class, 'index']);
Route::post('/goals', [GoalController::class, 'store']);
Route::put('/goals/{goal}', [GoalController::class, 'update']);
Route::delete('/goals/{goal}', [GoalController::class, 'destroy']);

Route::get('/goals-district', [GoalDistrictController::class, 'index']);
Route::get('/goals-district/{goalDistrict}', [GoalDistrictController::class, 'show']);
Route::post('/goals-district', [GoalDistrictController::class, 'store']);
Route::put('/goals-district/{goalDistrict}', [GoalDistrictController::class, 'update']);
Route::delete('/goals-district/{goalDistrict}', [GoalDistrictController::class, 'destroy']);


Route::get('/superAdmins', [SuperAdminController::class, 'index'])->middleware('auth:sanctum');
Route::get('/catalog/users', [CatalogController::class, 'getUsers'])->middleware('auth:sanctum');
Route::post('/superAdmins', [SuperAdminController::class, 'store'])->middleware('auth:sanctum');
Route::get('/superAdmins/{superAdmin}', [SuperAdminController::class, 'show'])->middleware('auth:sanctum');
Route::put('/superAdmins/{superAdmin}', [SuperAdminController::class, 'update'])->middleware('auth:sanctum');
Route::post("/superAdmins/{superAdmin}/upload-image", [SuperAdminController::class, 'uploadImage']);
Route::delete('/superAdmins/{superAdmin}', [SuperAdminController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('/promotores', [PromotorController::class, 'index'])->middleware('auth:sanctum');
Route::post("/promotores/{promotor}/upload-image", [PromotorController::class, 'uploadImage']);
Route::post('/promotores', [PromotorController::class, 'store'])->middleware('auth:sanctum');
Route::get('/promotores/{promotor}', [PromotorController::class, 'show'])->middleware('auth:sanctum');
Route::put('/promotores/{promotor}', [PromotorController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/promotores/{promotor}', [PromotorController::class, 'destroy'])->middleware('auth:sanctum');
Route::get('/promotor/{promotorId}/promoteds', [PromotorController::class, 'showPromoteds'])->middleware('auth:sanctum');
Route::get('/promotor/{promotorId}/promoteds/count', [PromotorController::class, 'showPromotedsCount'])->middleware('auth:sanctum');

Route::get('/promotors/{promotorId}/promoteds-count-by-municipality', [PromotorController::class, 'showPromotedsCountByMunicipality']); //mas datos 
Route::get('/promotors/{promotorId}/promoteds-count-municipality', [PromotorController::class, 'showPromotedsCountOnlyByMunicipality']); // solo municiopios
Route::get('/promotors/{promotorId}/districts/{districtId}/promoteds-count', [PromotorController::class, 'showPromotedsCountByDistrict']);

Route::get("/promoteds/map", [MapController::class, 'getPromoteds'])->middleware('auth:sanctum');

Route::get('/promoted', [PromotedController::class, 'index'])->middleware('auth:sanctum');
Route::post('/promoted', [PromotedController::class, 'store'])->middleware('auth:sanctum');
Route::get('/promoted/{id}', [PromotedController::class, 'show'])->middleware('auth:sanctum');
Route::put('/promoted/{id}', [PromotedController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/promoted/{id}', [PromotedController::class, 'destroy'])->middleware('auth:sanctum');




Route::post('/upload-excel/{promotorId}', [PromotedController::class, 'uploadExcel'])->middleware('auth:sanctum');
Route::get('/export-excel', [PromotedController::class, 'export'])->middleware('auth:sanctum');
Route::get('/export-excel-template', [PromotedController::class, 'exportTemplate']);

Route::get('/municipals', [MunicipalController::class, 'index'])->middleware('auth:sanctum');
Route::get('/municipals/{municipalId}/districts/{districtId}/promoveds/count', [MunicipalController::class, 'countPromovedsInDistrict'])->middleware('auth:sanctum');
Route::get('/municipals/districts/promoveds/count', [MunicipalController::class, 'countPromovedsInAll'])->middleware('auth:sanctum');
Route::get('/municipals/sections/promoveds/count', [MunicipalController::class, 'countPromovedsInSections'])->middleware('auth:sanctum');
Route::get('/municipals/sections/promoveds/count-by-date', [MunicipalController::class, 'countPromovedsInSectionsByDate'])->middleware('auth:sanctum');
Route::get('/municipals/districts/promoveds/count-by-date', [MunicipalController::class, 'countPromovedsInDistrictsByDate'])->middleware('auth:sanctum');
Route::get('/municipals/sections-with-promoved-count', [MunicipalController::class, 'sectionsWithPromovedCount'])->middleware('auth:sanctum');


Route::get('/districts/{id}', [DistrictController::class, 'show'])->middleware('auth:sanctum');

Route::get('/problems', [ProblemController::class, 'index'])->middleware('auth:sanctum'); // Listar todos los problemas
Route::post('/problems', [ProblemController::class, 'store'])->middleware('auth:sanctum'); // Crear un nuevo problema
Route::get('/problems/{problem}', [ProblemController::class, 'show'])->middleware('auth:sanctum'); // Mostrar un problema específico
Route::put('/problems/{problem}', [ProblemController::class, 'update'])->middleware('auth:sanctum'); // Actualizar un problema
Route::delete('/problems/{problem}', [ProblemController::class, 'destroy'])->middleware('auth:sanctum'); // Eliminar un problema



Route::get('/catalog/municipal', [CatalogController::class, 'MunicipalSelect'])->middleware('auth:sanctum');
Route::get('/municipals/{municipalId}/districts', [CatalogController::class, 'getDistrictsByMunicipal'])->middleware('auth:sanctum');
Route::get('/districts/{districtId}/sections', [CatalogController::class, 'getSectionsByDistrict'])->middleware('auth:sanctum');


Route::get("/dashboard/promoteds-by-promotor", [PromotedController::class, 'getPromotedByPromotors'])->middleware('auth:sanctum');
Route::get("/dashboard/promoteds-count-by-promotor", [PromotedController::class, 'getPromotedByDates'])->middleware('auth:sanctum');
Route::get("/dashboard/promoteds-count-by-dates", [PromotedController::class, 'getPromotedByDatesPage'])->middleware('auth:sanctum');


Route::get('/municipals/by-date-range', [MunicipalController::class, 'getMunicipalsByDateRange']);
Route::get('/municipals/total-promoteds', [MunicipalController::class, 'totalPromotedsByMunicipality']);

Route::get('/municipals/filters', [MunicipalController::class, 'getAllDataWithFilters']);
