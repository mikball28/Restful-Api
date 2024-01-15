<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\SmsFilterController;
use App\Http\Controllers\SmsReportAllController;
use App\Http\Controllers\SmsReportController;
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

 Route::post('/register',[RegisterController::class,('register')]);
 Route::post('/login',[AuthController::class,('login')]);

 Route::middleware('auth:api')->group(function () {

    Route::get('/sms-filter',[SmsFilterController::class,('SmsReportsFilter')]);
    Route::get('/sms-report',[SmsReportAllController::class,('SmsReport')]);
    Route::post('/send-sms',[SmsReportController::class,('sendSms')]);
    
});