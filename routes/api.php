<?php

use App\Http\Controllers\PmTableController;
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
Route::get('/pm-tables/index', [PmTableController::class , 'fetch']);
Route::post('/pm-tables/store', [PmTableController::class , 'store']);
Route::put('/pm-tables/update/{id}', [PmTableController::class , 'update']);
Route::delete('/pm-tables/destroy/{id}', [PmTableController::class , 'destroy']);
