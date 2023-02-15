<?php

use App\Http\Controllers\API\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Property;
use App\Models\Message;
use App\Http\Controllers\API\PropertyController;

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

Route::get('/properties', [PropertyController::class, 'index']);
Route::get('/properties/{property:slug}', [PropertyController::class, 'show']);
Route::get('/properties/search/lng={lng}/lat={lat}/radius={radius}', [PropertyController::class, 'searchProperties']);
Route::post('/messages', [MessageController::class, 'store']);
Route::get('/properties/filteredsearch/lng={lng}/lat={lat}/radius={radius}/rooms={rooms}/beds={beds}', [PropertyController::class, 'filteredSearch']);

