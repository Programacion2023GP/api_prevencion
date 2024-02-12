<?php

use App\Http\Controllers\ControllerSites;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::post('/auth/logout', [ControllerUsers::class, 'logout']);
Route::prefix('sites')->group(function () {
    Route::post('/create', [ControllerSites::class, 'create']);
    Route::post('/update', [ControllerSites::class, 'update']);
    Route::get('/index', [ControllerSites::class, 'index']);
    Route::post('/destroy/{id}', [ControllerSites::class, 'destroy']);

});
