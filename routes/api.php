<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriberController;

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

// Route::post('/get_download_link', [HomeController::class, 'getDownloadLink'])->name('get.download.link');
// Route::post('/support_ticket', [HomeController::class, 'createSupportTicket'])->name('send.support.ticket');
// Route::get('/get_user', [UserController::class, 'show']);

//Route::middleware(['auth:api'])->group(function () {
    Route::post('/get_download_link', [HomeController::class, 'getDownloadLink'])->name('get.download.link');
    Route::post('/support_ticket', [HomeController::class, 'createSupportTicket'])->name('send.support.ticket');
    
    Route::get('/get_user', [UserController::class, 'show']);
    Route::delete('/delete_user/{id}', [UserController::class, 'deleteUser']);

    Route::get('/get_subscribers', [SubscriberController::class, 'show']);
    Route::delete('/delete_subscriber/{id}', [SubscriberController::class, 'deleteSubscriber']);
//});