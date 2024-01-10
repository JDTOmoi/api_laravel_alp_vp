<?php

use App\Http\Controllers\api\AuthenticationController;
use App\Http\Controllers\api\DriverController;
use App\Http\Controllers\api\PlaceController;
use App\Http\Controllers\api\PromoController;
use App\Http\Controllers\api\RideController;
use App\Http\Controllers\api\User_RideController;
use App\Http\Controllers\api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('create_user', [UserController::class, 'createUser']);
Route::post('login', [AuthenticationController::class, 'login'])->name('login');

Route::middleware(['auth:sanctum'])->group(
    function () {
        // Route::get('all_user', [UserController::class, 'getAllUser']);
        // Route::patch('update_user', [UserController::class, 'updateUser']);
        // Route::delete('delete_user', [UserController::class, 'deleteUser']);
        // Route::get('driver', [DriverController::class, 'ListDriver']);
        // Route::post('driver', [DriverController::class, 'createDriver']);
        // Route::patch('driver', [DriverController::class, 'updateDriver']);
        // Route::delete('driver', [DriverController::class, 'deleteDriver']);
        // Route::get('place', [PlaceController::class, 'ListPlace']);
        // Route::post('place', [PlaceController::class, 'createPlace']);
        // Route::patch('place', [PlaceController::class, 'updatePlace']);
        // Route::delete('place', [PlaceController::class, 'deletePlace']);
        // Route::get('promo', [PromoController::class, 'ListPromo']);
        // Route::post('promo', [PromoController::class, 'createPromo']);
        // Route::patch('promo', [PromoController::class, 'updatePromo']);
        // Route::delete('promo', [PromoController::class, 'deletePromo']);
        // Route::get('ride_all', [RideController::class, 'getAllRides']);
        // Route::get('ride', [RideController::class, 'ListRide']);
        // Route::post('ride', [RideController::class, 'createRide']);
        // Route::patch('ride', [RideController::class, 'updateRide']);
        // Route::delete('ride', [RideController::class, 'deleteRide']);
        // Route::get('ur', [User_RideController::class, 'getAllURs']);
        // Route::get('ur_user', [User_RideController::class, 'ListURByUser']);
        // Route::get('ur_ride', [User_RideController::class, 'ListURByRide']);
        // Route::get('ur_promo', [User_RideController::class, 'ListURByPromo']);
        // Route::post('ur', [User_RideController::class, 'createUR']);
        // Route::patch('ur', [User_RideController::class, 'updateUR']);
        // Route::delete('ur', [User_RideController::class, 'deleteUR']);
        // Route::delete('logout', [AuthenticationController::class, 'logout']);
    }
);

Route::get('all_user', [UserController::class, 'getAllUser']);
Route::patch('update_user', [UserController::class, 'updateUser']);
Route::delete('delete_user', [UserController::class, 'deleteUser']);

Route::get('driver', [DriverController::class, 'ListDriver']);
Route::post('driver', [DriverController::class, 'createDriver']);
Route::patch('driver', [DriverController::class, 'updateDriver']);
Route::delete('driver', [DriverController::class, 'deleteDriver']);

Route::get('place', [PlaceController::class, 'ListPlace']);
Route::post('place', [PlaceController::class, 'createPlace']);
Route::patch('place', [PlaceController::class, 'updatePlace']);
Route::delete('place', [PlaceController::class, 'deletePlace']);

Route::get('promo', [PromoController::class, 'ListPromo']);
Route::post('promo', [PromoController::class, 'createPromo']);
Route::patch('promo', [PromoController::class, 'updatePromo']);
Route::delete('promo', [PromoController::class, 'deletePromo']);

Route::get('ride_all', [RideController::class, 'getAllRides']);
Route::get('ride', [RideController::class, 'getAllRides']);
Route::get('ride_user/{userId}', [RideController::class, 'ListRideByUser']);
Route::get('ride_driver', [RideController::class, 'ListRide']);
Route::get('ride/{rideId}', [RideController::class, 'getRideDetails']);
Route::post('ride', [RideController::class, 'createRide']);
Route::patch('ride', [RideController::class, 'updateRide']);
Route::delete('ride', [RideController::class, 'deleteRide']);
Route::get('join-ride/{rideId}', [RideController::class, 'joinRide']);

Route::get('ur', [User_RideController::class, 'getAllURs']);
Route::get('ur_user', [User_RideController::class, 'ListURByUser']);
Route::get('ur_ride', [User_RideController::class, 'ListURByRide']);
Route::get('ur_promo', [User_RideController::class, 'ListURByPromo']);
Route::get('ur_details', [User_RideController::class, 'DriverStandbyRideDetails']);
Route::post('ur', [User_RideController::class, 'createUR']);
Route::patch('ur', [User_RideController::class, 'updateUR']);
Route::delete('ur', [User_RideController::class, 'deleteUR']);

Route::delete('logout', [AuthenticationController::class, 'logout']);
Route::get('check-user', [UserController::class, 'checkUser']);
