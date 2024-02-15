<?php

use App\Http\Controllers\ControllerActivies;
use App\Http\Controllers\ControllerActwas;
use App\Http\Controllers\ControllerAdictions;
use App\Http\Controllers\ControllerBelief;
use App\Http\Controllers\ControllerCause;
use App\Http\Controllers\ControllerChildrens;
use App\Http\Controllers\ControllerDependence;
use App\Http\Controllers\ControllerDiseases;
use App\Http\Controllers\ControllerExistence;
use App\Http\Controllers\ControllerFamily;
use App\Http\Controllers\ControllerGender;
use App\Http\Controllers\ControllerIndentified;
use App\Http\Controllers\ControllerLiteracy;
use App\Http\Controllers\ControllerMeanEmployees;
use App\Http\Controllers\ControllerSchool;
use App\Http\Controllers\ControllerSites;
use App\Http\Controllers\ControllerStateCivil;
use App\Http\Controllers\ControllerSuicidePreventions;
use App\Http\Controllers\ControllerUsers;
use App\Http\Controllers\ControllerViolence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function(){

// Route::post('/auth/logout', [ControllerUsers::class, 'logout']);
    Route::prefix('sites')->group(function () {
        Route::post('/create', [ControllerSites::class, 'create']);
        Route::post('/update', [ControllerSites::class, 'update']);
        Route::get('/index', [ControllerSites::class, 'index']);
        Route::post('/destroy/{id}', [ControllerSites::class, 'destroy']);
        Route::get('/values', [ControllerSites::class, 'values']);

    });
    Route::prefix('meanemployeed')->group(function () {
        Route::post('/create', [ControllerMeanEmployees::class, 'create']);
        Route::post('/update', [ControllerMeanEmployees::class, 'update']);
        Route::get('/index', [ControllerMeanEmployees::class, 'index']);
        Route::post('/destroy/{id}', [ControllerMeanEmployees::class, 'destroy']);
        Route::get('/values', [ControllerMeanEmployees::class, 'values']);

    });
    Route::prefix('gender')->group(function () {
        Route::post('/create', [ControllerGender::class, 'create']);
        Route::post('/update', [ControllerGender::class, 'update']);
        Route::get('/index', [ControllerGender::class, 'index']);
        Route::post('/destroy/{id}', [ControllerGender::class, 'destroy']);
        Route::get('/values', [ControllerGender::class, 'values']);

    });
    Route::prefix('cause')->group(function () {
        Route::post('/create', [ControllerCause::class, 'create']);
        Route::post('/update', [ControllerCause::class, 'update']);
        Route::get('/index', [ControllerCause::class, 'index']);
        Route::post('/destroy/{id}', [ControllerCause::class, 'destroy']);
        Route::get('/values', [ControllerCause::class, 'values']);

    });
    Route::prefix('dependence')->group(function () {
        Route::post('/create', [ControllerDependence::class, 'create']);
        Route::post('/update', [ControllerDependence::class, 'update']);
        Route::get('/index', [ControllerDependence::class, 'index']);
        Route::get('/values', [ControllerDependence::class, 'values']);

        Route::post('/destroy/{id}', [ControllerDependence::class, 'destroy']);

    });
    Route::prefix('belief')->group(function () {
        Route::post('/create', [ControllerBelief::class, 'create']);
        Route::post('/update', [ControllerBelief::class, 'update']);
        Route::get('/index', [ControllerBelief::class, 'index']);
        Route::post('/destroy/{id}', [ControllerBelief::class, 'destroy']);
        Route::get('/values', [ControllerBelief::class, 'values']);

    });
    Route::prefix('statecivil')->group(function () {
        Route::post('/create', [ControllerStateCivil::class, 'create']);
        Route::post('/update', [ControllerStateCivil::class, 'update']);
        Route::get('/index', [ControllerStateCivil::class, 'index']);
        Route::post('/destroy/{id}', [ControllerStateCivil::class, 'destroy']);
        Route::get('/values', [ControllerStateCivil::class, 'values']);

    });
    Route::prefix('literacy')->group(function () {
        Route::post('/create', [ControllerLiteracy::class, 'create']);
        Route::post('/update', [ControllerLiteracy::class, 'update']);
        Route::get('/index', [ControllerLiteracy::class, 'index']);
        Route::post('/destroy/{id}', [ControllerLiteracy::class, 'destroy']);
        Route::get('/values', [ControllerLiteracy::class, 'values']);

    });
    Route::prefix('childrens')->group(function () {
        Route::post('/create', [ControllerChildrens::class, 'create']);
        Route::post('/update', [ControllerChildrens::class, 'update']);
        Route::get('/index', [ControllerChildrens::class, 'index']);
        Route::post('/destroy/{id}', [ControllerChildrens::class, 'destroy']);
        Route::get('/values', [ControllerChildrens::class, 'values']);

    });
    Route::prefix('existence')->group(function () {
        Route::post('/create', [ControllerExistence::class, 'create']);
        Route::post('/update', [ControllerExistence::class, 'update']);
        Route::get('/index', [ControllerExistence::class, 'index']);
        Route::post('/destroy/{id}', [ControllerExistence::class, 'destroy']);
        Route::get('/values', [ControllerExistence::class, 'values']);

    });
    Route::prefix('adictions')->group(function () {
        Route::post('/create', [ControllerAdictions::class, 'create']);
        Route::post('/update', [ControllerAdictions::class, 'update']);
        Route::get('/index', [ControllerAdictions::class, 'index']);
        Route::post('/destroy/{id}', [ControllerAdictions::class, 'destroy']);
        Route::get('/values', [ControllerAdictions::class, 'values']);

    });
    Route::prefix('diseases')->group(function () {
        Route::post('/create', [ControllerDiseases::class, 'create']);
        Route::post('/update', [ControllerDiseases::class, 'update']);
        Route::get('/index', [ControllerDiseases::class, 'index']);
        Route::post('/destroy/{id}', [ControllerDiseases::class, 'destroy']);
        Route::get('/values', [ControllerDiseases::class, 'values']);

    });
    Route::prefix('violence')->group(function () {
        Route::post('/create', [ControllerViolence::class, 'create']);
        Route::post('/update', [ControllerViolence::class, 'update']);
        Route::get('/index', [ControllerViolence::class, 'index']);
        Route::post('/destroy/{id}', [ControllerViolence::class, 'destroy']);
        Route::get('/values', [ControllerViolence::class, 'values']);

    });
    Route::prefix('family')->group(function () {
        Route::post('/create', [ControllerFamily::class, 'create']);
        Route::post('/update', [ControllerFamily::class, 'update']);
        Route::get('/index', [ControllerFamily::class, 'index']);
        Route::post('/destroy/{id}', [ControllerFamily::class, 'destroy']);
        Route::get('/values', [ControllerFamily::class, 'values']);

    });
    Route::prefix('school')->group(function () {
        Route::post('/create', [ControllerSchool::class, 'create']);
        Route::post('/update', [ControllerSchool::class, 'update']);
        Route::get('/index', [ControllerSchool::class, 'index']);
        Route::post('/destroy/{id}', [ControllerSchool::class, 'destroy']);
        Route::get('/values', [ControllerSchool::class, 'values']);

    });
    Route::prefix('indentified')->group(function () {
        Route::post('/create', [ControllerIndentified::class, 'create']);
        Route::post('/update', [ControllerIndentified::class, 'update']);
        Route::get('/index', [ControllerIndentified::class, 'index']);
        Route::post('/destroy/{id}', [ControllerIndentified::class, 'destroy']);
        Route::get('/values', [ControllerIndentified::class, 'values']);

    });
    Route::prefix('actwas')->group(function () {
        Route::post('/create', [ControllerActwas::class, 'create']);
        Route::post('/update', [ControllerActwas::class, 'update']);
        Route::get('/index', [ControllerActwas::class, 'index']);
        Route::post('/destroy/{id}', [ControllerActwas::class, 'destroy']);
        Route::get('/values', [ControllerActwas::class, 'values']);

    });
    Route::prefix('users')->group(function () {
        Route::post('/create', [ControllerUsers::class, 'signup']);
        Route::post('/update', [ControllerUsers::class, 'update']);
        Route::post('/destroy/{id}', [ControllerUsers::class, 'destroy']);
        Route::get('/index', [ControllerUsers::class, 'index']);

    });
    Route::prefix('activies')->group(function () {
        Route::post('/create', [ControllerActivies::class, 'create']);
        Route::post('/update', [ControllerActivies::class, 'update']);
        Route::get('/index', [ControllerActivies::class, 'index']);
        Route::post('/destroy/{id}', [ControllerActivies::class, 'destroy']);
        Route::get('/values', [ControllerActivies::class, 'values']);

    });
    Route::prefix('prevention')->group(function () {
        Route::post('/create', [ControllerSuicidePreventions::class, 'create']);
        Route::get('/findIndex', [ControllerSuicidePreventions::class, 'findIndex']);
        Route::get('/show', [ControllerSuicidePreventions::class, 'Show']);
        

    });
    Route::prefix('auth')->group(function () {

        Route::post('/logout', [ControllerUsers::class, 'logout']);
    });
});
Route::prefix('auth')->group(function () {

    Route::post('/login', [ControllerUsers::class, 'login']);


});
Route::get("hola", function() {
    return "hola";
});
