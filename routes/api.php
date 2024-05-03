<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;

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

Route::get('rent-list', [Api\StoreRent::class, 'show']);
Route::get('acessory', [Api\AcessoryController::class, 'show']);
Route::get('start/{id}', [Api\ListItemsController::class, 'show']);
Route::get('postoyanniki/{number}', [Api\Postoyanniki::class, 'show']);
Route::get('category', [Api\CategoryController::class, 'show']);
Route::get('elements/{cat_id}', [Api\ElementController::class, 'show']);
Route::get('statistics/{start}/{stop}', [Api\StatisticsController::class, 'show']);


Route::post('change-stat', [Api\StatisticsController::class, 'update']);
Route::post('delete-stat', [Api\StatisticsController::class, 'delete']);
Route::post('delete-photo', [Api\StatisticsController::class, 'deletePhoto']);

Route::post('upload', [Api\UploadPhoto::class, 'store']);
Route::post('add-client', [Api\StoreClient::class, 'store']);

Route::post('set-shileds', [Api\ElementController::class, 'setShield']);
Route::post('set-repair', [Api\ElementController::class, 'setRepair']);

Route::post('add-rashod', [Api\RashoController::class, 'store']);

Route::post('add-rent', [Api\StoreRent::class, 'store']);
Route::post('add-rent-add', [Api\StoreRent::class, 'add']);
Route::post('set-pause', [Api\StoreRent::class, 'setPause']);
Route::post('del-pause', [Api\StoreRent::class, 'delPause']);
Route::post('stop-rent', [Api\StoreRent::class, 'stop']);
Route::post('stop-rent-all', [Api\StoreRent::class, 'stopAll']);
Route::post('update-rent', [Api\StoreRent::class, 'update']);

Route::post('set-acessory', [Api\AcessoryController::class, 'store']);

