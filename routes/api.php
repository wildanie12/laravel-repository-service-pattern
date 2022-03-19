<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::post('/users/login', [AuthController::class, 'login']);
// Route::post('/users/login', function() {
//     return response()->json(['ok' => true]);
// });


Route::middleware(['auth:sanctum'])->group(function() {
    Route::post('/users/logout', [AuthController::class, 'logout']);
    Route::get('/users', [UserController::class, 'index']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
