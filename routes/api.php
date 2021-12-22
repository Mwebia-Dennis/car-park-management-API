<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserCarParkController;
use App\Http\Controllers\CarPark\CarParkController;

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


Route::post('auth/signup', [AuthController::class, 'signup']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/forgot-password', [AuthController::class, 'forgotPassword']);
Route::get('auth/check-account', [AuthController::class, 'checkEmail']);
Route::get('auth/verify-email/{verification_token}', [AuthController::class, 'emailVerificationHandler']);
Route::get('auth/verification-resend', [AuthController::class, 'resendingVerificationEmail']);

Route::middleware('auth:api')->group(function () {
        
    //authenticated user info
    Route::get('auth/user-details', [AuthController::class, 'userDetails']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::resource('users.car-park', UserCarParkController::class)->except(['edit', 'create', 'show']);
    Route::resource('car-parks', CarParkController::class)->only(['index', 'show']);
    
    

});


Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@company.com'], 404);
});