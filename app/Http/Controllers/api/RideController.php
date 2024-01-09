<?php

namespace App\Http\Controllers\api;

use App\Models\Ride;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RideResource;
use App\Models\User_Ride;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class RideController extends Controller
{
    public function getAllRides()
    {
        $rides = Ride::all();
        return $rides;
        // return RideResource::collection($rides);
    }

    public function ListRide(Request $request)
    {
        $driver = Driver::where('driver_id', $request->driver_id)->first();
        $rides = $driver->rides()->get();
        return [
            'status' => Response::HTTP_OK,
            'message' => 'Success',
            'data' => RideResource::collection($rides)
        ];
    }

    public function ListRideByUser(Request $request)
    {
        $driver = User::where('user_id', $request->user_id)->first();
        $rides = $driver->urs()->flatMap(function ($ur) {
            return $ur->ride;
        });
        return [
            'status' => Response::HTTP_OK,
            'message' => 'Success',
            'data' => RideResource::collection($rides)
        ];
    }

    public function createRide(Request $request)
    {

        $user_id = $request->user_id;

        if ($user_id != -1 && $user_id != null) {
            try {
                $driver = Driver::where('user_id', $user_id)->first();
                $driverId = $driver->user->user_id;

                if ($driver && $driverId != null) {
                    $ride = new Ride();
                    $ride->driver_id = $driverId;
                    $ride->ride_status = "0";
                    $ride->start_location = $request->start_location;
                    $ride->destination_location = $request->destination_location;
                    $ride->start_lat = $request->start_lat;
                    $ride->start_lng = $request->start_lng;
                    $ride->destination_lat = $request->destination_lat;
                    $ride->destination_lng = $request->destination_lng;
                    $ride->going_date = $request->going_date;
                    $ride->going_time = $request->going_time;
                    $ride->car_model = $request->car_model;
                    $ride->car_license_plate = $request->car_license_plate;
                    $ride->car_capacity = $request->car_capacity;
                    $ride->notes = $request->notes;
                    $ride->save();
                    return [
                        'status' => Response::HTTP_OK,
                        'message' => "Success",
                        'ride_id' => $ride->ride_id,
                        'driver_id' => $ride->driver_id,
                        'ride_status' => $ride->status,
                        'start_location' => $ride->start_location,
                        'destination_location' => $ride->destination_location,
                        'start_lat' => $ride->start_lat,
                        'start_lng' => $ride->start_lng,
                        'destination_lat' => $ride->destination_lat,
                        'destination_lng' => $ride->destination_lng,
                        'going_date' => $ride->going_date,
                        'going_time' => $ride->going_time,
                        'car_model' => $ride->car_model,
                        'car_license_plate' => $ride->car_license_plate,
                        'car_capacity' => $ride->car_capacity,
                        'notes' => $ride->notes
                    ];
                } else {
                    return [
                        'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                        'message' => "Driver not found"
                    ];
                }
            } catch (Exception $e) {
                return [
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                    'data' => []
                ];
            }
        } else {
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => "couldn't get user id in parameter.",
                'data' => []
            ];
        }
    }

    public function joinRide(Request $request, $rideId)
    {
        $ride = Ride::where('ride_id', $rideId)->first();

        if ($ride != null) {

            return [
                'status' => Response::HTTP_OK,
                'message' => "Success",
                'ride_id' => $ride->ride_id
            ];
        } else {
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => "Unnable to get ride id",
            ];
        }
    }

    public function getRideDetails(Request $request, $rideId)
    {
        $ride = Ride::where('ride_id', $rideId)->first();
        // if ($ride != null) {

        //     return [
        //         'ride' => $ride->ride_id,
        //         'driver_id' => $ride->driver_id
        //     ];
        // }

        $driver = Driver::where('driver_id', $ride->driver_id)->first();
        if ($driver == null) {
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'cannot get driver in api',
            ];
        }
        $user = $driver->user;
        $total_entries = User_Ride::where('ride_id', $request->ride_id)->count();

        if (!empty($ride)) {
            try {
                return [
                    'status' => Response::HTTP_OK,
                    'message' => "Success",
                    'ride_id' => $ride->ride_id,
                    'driver_id' => $ride->driver_id,
                    'driver_name' => $user->name,
                    'passengers' => $total_entries,
                    'ride_status' => $ride->ride_status,
                    'start_location' => $ride->start_location,
                    'destination_location' => $ride->destination_location,
                    'start_lat' => $ride->start_lat,
                    'start_lng' => $ride->start_lng,
                    'destination_lat' => $ride->destination_lat,
                    'destination_lng' => $ride->destination_lng,
                    'going_date' => $ride->going_date,
                    'going_time' => $ride->going_time,
                    'car_model' => $ride->car_model,
                    'car_license_plate' => $ride->car_license_plate,
                    'car_capacity' => $ride->car_capacity,
                    'notes' => $ride->notes
                ];
            } catch (Exception $e) {
                return [
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                    'data' => []
                ];
            }
        } else {
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => "no ride found"
            ];
        }
    }

    public function updateRide(Request $request)
    {
        $ride = Ride::where('ride_id', $request->ride_id)->first();

        if (!empty($ride)) {
            try {
                $ride = new Ride();
                $ride->driver_id = $request->driver_id;
                $ride->status = $request->status;
                $ride->start_location = $request->start_location;
                $ride->destination_location = $request->destination_location;
                $ride->going_time = $request->going_time;
                $ride->car_model = $request->car_model;
                $ride->car_plate_number = $request->car_plate_number;
                $ride->save();
                return [
                    'status' => Response::HTTP_OK,
                    'message' => "Success",
                    'data' => $ride
                ];
            } catch (Exception $e) {
                return [
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                    'data' => []
                ];
            }
        }

        return [
            'status' => Response::HTTP_NOT_FOUND,
            'message' => "Ride not found",
            'data' => []
        ];
    }
    public function deleteRide(Request $request)
    {
        $ride = Ride::where('ride_id', $request->ride_id)->first();
        $ride->delete();

        return [
            'status' => Response::HTTP_OK,
            'message' => 'Success',
            'data' => $ride
        ];
    }
}
