<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SuitController;
use App\Http\Controllers\ShirtController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KabaSlitController;
use App\Http\Controllers\ShortTrouserController;
use App\Http\Controllers\BlouseDressSkirtController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home
Route::get('/', function () {
    return view('auth.login');
});


/**
 * Only authenticated users can access routes beyond
 */
Auth::routes();

// Dashboard
Route::controller(HomeController::class)->group(function() {

    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/profile', 'profilePage')->name('profile');
    Route::post('/profile/create', 'storeProfile')->name('profile.create');
    Route::post('/profile/update', 'updatePassword')->name('profile.update');
});

/**
 *  MEASUREMENT ROUTES
 */

// Customer
Route::controller(CustomerController::class)->middleware('auth')->group(function() {

    Route::get('/customer', 'customerPage')->name('customer');
    Route::get('/search', 'searchPage')->name('search');
    Route::get('/selection', 'selectionPage')->name('choose');
    Route::get('/customer/{customer}/selection', 'customerSelectionPage')->name('customer.selection');
    Route::get('/customer/{customer}', 'showCustomer')->name('show.customer');
    Route::post('customer/create', 'createCustomer')->name('customer.create');
    Route::put('/customer/{customer}/update', 'updateCustomer')->name('update.customer');
    Route::delete('/customer/{customer}/delete', 'deleteCustomer')->name('delete.customer');
});


// Suit
Route::controller(SuitController::class)->middleware('auth')->group(function() {

    Route::get('/suit', 'suitPage')->name('suit');
    Route::get('/suit/edit', 'editSuitPage')->name('edit.suit');
    Route::post('/suit/create', 'createSuit')->name('create.suit');
    Route::put('/suit/update', 'updateSuit')->name('update.suit');
});

// Shirt
Route::controller(ShirtController::class)->middleware('auth')->group(function() {

    Route::get('/shirt', 'shirtPage')->name('shirt');
    Route::get('/shirt/edit', 'editShirtPage')->name('edit.shirt');
    Route::post('/shirt/create', 'createShirt')->name('create.shirt');
    Route::put('/shirt/update', 'updateShirt')->name('update.shirt');
});

// Trouser/Shorts
Route::controller(ShortTrouserController::class)->middleware('auth')->group(function() {

    Route::get('/trouser-shorts', 'shortTrouserPage')->name('short.trouser');
    Route::get('/trouser-shorts/edit', 'editShortTrouserPage')->name('edit.short.trouser');
    Route::post('/trouser-shorts/create', 'createShortTrouser')->name('create.short.trouser');
    Route::put('/trouser-shorts/update', 'updateShortTrouser')->name('update.short.trouser');
});

// Blouser/Dress/Skirt
Route::controller(BlouseDressSkirtController::class)->middleware('auth')->group(function() {

    Route::get('/blouse-dress-skirt', 'blouseDressSkirtPage')->name('blouse.dress.skirt');
    Route::get('/blouse-dress-skirt/edit', 'editBlouseDressSkirt')->name('edit.blouse.dress.skirt');
    Route::post('/blouse-dress-skirt/create', 'createBlouseDressSkirt')->name('create.blouse.dress.skirt');
    Route::put('/blouse-dress-skirt/update', 'updateBlouseDressSkirt')->name('update.blouse.dress.skirt');
});

// Kaba & Slit
Route::controller(KabaSlitController::class)->middleware('auth')->group(function() {

    Route::get('/kaba-slit', 'kabaSlitPage')->name('kaba.slit');
    Route::get('/kaba-slit/edit', 'editKabaSlit')->name('edit.kaba.slit');
    Route::post('/kaba-slit/create', 'createKabaSlit')->name('create.kaba.slit');
    Route::put('/kaba-slit/update', 'updateKabaSlit')->name('update.kaba.slit');
});

/**
 *  Search/Filterartion
 */
Route::controller(HomeController::class)->middleware('auth')->group(function() {

    Route::post('/search', 'search')->name('search');
    Route::get('/today-customers', 'filterTodayCustomers')->name('customers.created.today');
    Route::get('/this-month-customers', 'filterMonthOfCustomers')->name('customers.created.by.month');
    Route::get('/this-year-customers', 'filterYearOfCustomers')->name('customers.created.by.year');
});

/**
 *  Sending email
 */
Route::controller(MailController::class)->middleware('auth')->group(function() {

    Route::get('/support', 'supportPage')->name('support');
    Route::post('/send/support', 'sendSupport')->name('send.support');
    Route::post('/cancel/subscription', 'cancelSubscription')->name('cancel.subscription');
});

/**
 *  Send SMS to customer for pick up
 */
Route::controller(CustomerController::class)->middleware('auth')->group(function() {

    Route::get('/create/{customer}/message', 'createSMSMessage')->name('create.message');
    Route::post('/send/message', 'sendSMSMessage')->name('send.message');
});

/**
 * Paystack payment
 */
Route::controller(PaymentController::class)->middleware('auth')->group(function () {

    Route::get('/payment/subscription/{customer}', 'subscriptionPage')->name('subscription');
    Route::get('/payment/verification/{reference}', 'verifySubscription')->name('verify');
});
