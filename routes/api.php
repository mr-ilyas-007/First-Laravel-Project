<?php

use App\Http\Controllers\API\AccountAPIController;
use App\Http\Controllers\API\ApiUserController;
use App\Http\Controllers\API\ContactAPIController;
use App\Http\Controllers\API\UserAPIController;
use App\Models\User;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('/ApiUsers', UserAPIController::class);
    Route::get('/ApiUsers/trashed', [UserAPIController::class,  'trashed']);
    Route::patch('/ApiUsers/restore/{id}', [UserAPIController::class, 'restore']);
    Route::delete('/ApiUsers/force-delete/{id}', [UserAPIController::class, 'forceDelete']);

    Route::apiResource('ApiAccounts', AccountAPIController::class);
    Route::get('/ApiAccounts/trashed', [AccountAPIController::class,  'trashed']);
    Route::patch('/ApiAccounts/restore/{id}', [AccountAPIController::class, 'restore']);
    Route::delete('/ApiAccounts/force-delete/{id}', [AccountAPIController::class, 'forceDelete']);

    Route::apiResource('ApiContacts', ContactAPIController::class);
    Route::get('/ApiContacts/trashed', [ContactAPIController::class,  'trashed']);
    Route::patch('/ApiContacts/restore/{id}', [ContactAPIController::class, 'restore']);
    Route::delete('/ApiContacts/force-delete/{id}', [ContactAPIController::class, 'forceDelete']);
});


///////////////////////////////////////////////////////////////////////////////////////////////////
Route::post('/login', [UserAPIController::class, 'login']);
