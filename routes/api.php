<?php

use App\Http\Controllers\api\HotSpotController;
use App\Http\Controllers\api\KecamatanController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/hospot-view-api', [KecamatanController::class, 'viewHotspot']);
Route::get('/hospot-point-api', [HotSpotController::class, 'viewHotspotPoint']);
