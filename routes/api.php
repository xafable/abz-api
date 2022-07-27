<?php

use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::apiResource('users', UserController::class);

Route::apiResource('positions', PositionController::class)->only('index');


Route::get('/token', function () {
    $user = User::query()->where('name','TokenBot')->first();
    $token = $user->createToken('abztoken');
    return response()->json([
        'success' => 'true',
        'token' => $token->plainTextToken,
    ]);
});


