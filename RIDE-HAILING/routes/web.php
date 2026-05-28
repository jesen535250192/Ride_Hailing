<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::get('/order', [OrderController::class, 'create'])
        ->name('order.create');

    Route::post('/order', [OrderController::class, 'store'])
        ->name('order.store');

    Route::get('/history', [HistoryController::class, 'index'])
        ->name('history.index');

    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::get('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');
        Route::get('/driver/my-orders', [OrderController::class, 'myDriverOrders'])
    ->name('driver.my.orders');
});
Route::get('/driver/income', [OrderController::class, 'driverIncome'])
    ->name('driver.income');
Route::middleware(['auth', 'driver'])->group(function () {

    Route::get('/driver/orders', [OrderController::class, 'driverOrders'])
        ->name('driver.orders');

    Route::get('/driver/order/{id}/status/{status}', [OrderController::class, 'updateStatus'])
        ->name('driver.order.status');
});


require __DIR__.'/auth.php';