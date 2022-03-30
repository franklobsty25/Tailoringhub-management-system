<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TailoringhubApiController;

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

// Tailor/Seamstree credentials
Route::controller(TailoringhubApiController::class)->group(function() {

    Route::post('/login', 'login');
    Route::post('/register', 'register');
});

// User detail
Route::controller(TailoringhubApiController::class)->middleware('auth:sanctum')->group(function() {

    Route::get('/profile', 'getUserProfile');
    Route::get('/logout', 'logout');
    Route::post('/create/profile-image', 'createProfileImage');
    Route::post('/create/profile', 'createUserProfile');
    Route::put('/update/profile', 'updateUserProfile');
    Route::put('/change-password', 'changeUserPassword');
});


// Customer Profile
Route::controller(TailoringhubApiController::class)->middleware('auth:sanctum')->group(function() {

    Route::get('/customers', 'getCustomers');
    Route::get('/customer/search/{contact}', 'searchCustomer');
    Route::get('/customer/{contact}/measurement', 'getCustomerMeasurement');
    Route::post('/create/customer', 'createCustomerProfile');
    Route::put('/update/customer', 'updateCustomerProfile');
    Route::delete('/delete/customer/{contact}', 'deleteCustomerProfile');
});


// Suit
Route::controller(TailoringhubApiController::class)->middleware('auth:sanctum')->group(function() {

    Route::post('/create/suit', 'createSuit');
    Route::put('/update/suit', 'updateSuit');
});


// Shirt [long/short]
Route::controller(TailoringhubApiController::class)->middleware('auth:sanctum')->group(function() {

    Route::post('/create/shirt', 'createShirt');
    Route::put('/update/shirt', 'updateShirt');
});


// Shorts/Trouser
Route::controller(TailoringhubApiController::class)->middleware('auth:sanctum')->group(function() {

    Route::post('/create/shorts-trouser', 'createShortsTrouser');
    Route::put('/update/shorts-trouser', 'updateShortsTrouser');
});


// Blouse/Dress/Skirt
Route::controller(TailoringhubApiController::class)->middleware('auth:sanctum')->group(function() {

    Route::post('/create/blouse-dress-skirt', 'createBlouseDressSkirt');
    Route::put('/update/blouse-dress-skirt', 'updateBlouseDressSkirt');
});


// Kaba & Slit
Route::controller(TailoringhubApiController::class)->middleware('auth:sanctum')->group(function() {

    Route::post('/create/kaba-slit', 'createKabaSlit');
    Route::put('/update/kaba-slit', 'updateKabaSlit');
});

// Monthly Subscription
Route::controller(TailoringhubApiController::class)->middleware('auth:sanctum')->group(function() {

    Route::get('/verify/payment/{reference}', 'verifySubscription');
    Route::post('/subscription/payment', 'initialiseSubscription');
});

// Send suggestions/cancel subscription
Route::controller(TailoringhubApiController::class)->middleware('auth:sanctum')->group(function() {

    Route::post('/send/suggestion', 'sendMail');
    Route::post('/cancel/subscription', 'cancelSubscription');
});

// Send SMS message customer
Route::middleware('auth:sanctum')->post('/send/message', [App\Http\Controllers\TailoringhubApiController::class, 'sendCustomerSMS']);
