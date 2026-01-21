<?php

use App\Http\Controllers\API\BallroomController;
use App\Http\Controllers\API\ElementController;
use App\Http\Controllers\API\GuestController;
use App\Http\Controllers\API\GuestNoteController;
use App\Http\Controllers\API\RegisterController;
use Illuminate\Support\Facades\Route;

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
});

//Used
Route::apiResource('element', ElementController::class);
Route::get('element/ballroom/{ballroom_id}', [ElementController::class, 'getBallroomElements']);
Route::post('seat', [ElementController::class, 'createSeat']);
Route::put('seat/{seatId}', [ElementController::class, 'assignElementAndGuestToSeat']);
Route::get('ballroom/{ballroomId}/getSeats/', [ElementController::class, 'getBallroomSeats']);
Route::get('guest/getlist/{ballroom_id}', [GuestController::class, 'getGuests']);
Route::delete('seat/{seatId}', [ElementController::class, 'releaseSeat']);
Route::post('/guest-notes', [GuestNoteController::class, 'store']);
Route::put('/guest-notes/{guest_id}', [GuestNoteController::class, 'update']);
Route::get('guest/export/{ballroom_id}', [GuestController::class, 'export']);

//Maybe will be used in future
Route::get('ballroom/getElements/{ballroom_id}', [BallroomController::class, 'getBallroom']);
Route::delete('seat/element/{elementId}', [ElementController::class, 'releaseSeatsByElement']);
Route::delete('seat/ballroom/{ballroomId}', [ElementController::class, 'releaseSeatsByBallroom']);
Route::get('element/{elementId}/getSeats/', [ElementController::class, 'getElementSeats']);

Route::middleware('auth:sanctum')->group( function () {
    Route::get('user', function (Request $request) {
        return $request->user();
    })->name('user');
});
