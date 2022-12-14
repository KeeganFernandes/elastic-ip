<?php

use App\Http\Controllers\AccessConcentrator;
use App\Http\Controllers\IpPoolController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserElasticIpController;
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

Route::apiResource("/access-concentrator", AccessConcentrator::class, ["only" => ["index", "show"]]);

Route::apiResource("/ip-pool", IpPoolController::class);

Route::put("/pool-assigment/{access_concentrator_id}", [AccessConcentrator::class, "pool_assigment"]);

Route::apiResource("/manage", UserElasticIpController::class, ["only" => ["index", "show", "update"]]);

Route::post("/site/{subscription_id}", [SiteController::class, "assignment"]);
Route::get("/site", [SiteController::class, "index"]);
Route::put("/site/recommit/{subscription_id}", [SiteController::class, "recommit"]);
