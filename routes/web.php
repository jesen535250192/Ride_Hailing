<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Route yang bisa diakses SEMUA USER yang sudah login
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Chat (Customer & Driver)
    |--------------------------------------------------------------------------
    */

    Route::get('/orders/{order}/chat', [MessageController::class, 'index'])
        ->name('chat.index');

    Route::post('/orders/{order}/chat', [MessageController::class, 'store'])
        ->name('chat.store');
});

/*
|--------------------------------------------------------------------------
| CUSTOMER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'customer'])->group(function () {

    Route::get('/order', [OrderController::class, 'create'])
        ->name('order.create');

    Route::post('/order', [OrderController::class, 'store'])
        ->name('order.store');

    Route::get('/history', [HistoryController::class, 'index'])
        ->name('history.index');

    /*
    |--------------------------------------------------------------------------
    | Payment
    |--------------------------------------------------------------------------
    */

    Route::resource('payments', PaymentController::class);

    /*
    |--------------------------------------------------------------------------
    | Rating
    |--------------------------------------------------------------------------
    */

    Route::get('/ratings/{order}/create', [RatingController::class, 'create'])
        ->name('ratings.create');

    Route::post('/ratings/{order}', [RatingController::class, 'store'])
        ->name('ratings.store');
});

/*
|--------------------------------------------------------------------------
| DRIVER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'driver'])->group(function () {

    Route::get('/driver/orders', [OrderController::class, 'driverOrders'])
        ->name('driver.orders');

    Route::get('/driver/my-orders', [OrderController::class, 'myDriverOrders'])
        ->name('driver.my.orders');

    Route::get('/driver/income', [OrderController::class, 'driverIncome'])
        ->name('driver.income');

    Route::get('/driver/order/{id}/status/{status}', [OrderController::class, 'updateStatus'])
        ->name('driver.order.status');

    /*
    |--------------------------------------------------------------------------
    | Rating Driver
    |--------------------------------------------------------------------------
    */

    Route::get('/driver/ratings', [RatingController::class, 'index'])
        ->name('ratings.index');
});

require __DIR__ . '/auth.php';