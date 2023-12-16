<?php

namespace App\Http\Controllers\api;

use App\Models\Ride;
use App\Models\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RideResource;
use Symfony\Component\HttpFoundation\Response;

class RideController extends Controller
{
    public function getAllRides(){
        $rides = Ride::all();
        return RideResource::collection($rides);
    }

    public function ListRide(){
        $driver = Driver::where('driver_id', $request->driver_id)->first();
        $rides = $driver->rides()->get();
        return [
            'status' => Response::HTTP_OK,
            'message' => 'Success',
            'data' => RideResource::collection($rides)
        ];
    }

    public function createRide(Request $request){
        try{
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
        }catch(Exception $e){
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }
    }

    public function updateRide(Request $request){
        $ride = Ride::where('ride_id', $request->ride_id)->first();

        if(!empty($ride)){
            try{
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
            }catch(Exception $e){
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
    public function deleteRide(Request $request) {
        $ride = Ride::where('ride_id', $request->ride_id)->first();
        $ride->delete();

        return [
            'status' =>Response::HTTP_OK,
            'message' => 'Success',
            'data' => $ride
        ];
    }
}
