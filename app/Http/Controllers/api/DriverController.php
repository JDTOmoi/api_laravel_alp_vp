<?php

namespace App\Http\Controllers\api;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DriverResource;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class DriverController extends Controller
{
    public function ListDriver(Request $request){
        $drivers = Driver::all();
        return DriverResource::collection($drivers);
    }

    public function createDriver(Request $request){
        try{
            $driver = new Driver();
            $driver->user_id = $request->user_id;
            $driver->save();
            return [
                'status' => Response::HTTP_OK,
                'message' => "Success",
                'data' => $driver
            ];
        }catch(Exception $e){
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }
    }

    public function updateDriver(Request $request){
        $driver = Driver::where('driver_id', $request->driver_id)->first();

        if(!empty($driver)){
            try{
                $driver = new Driver();
                $driver->user_id = $request->user_id;
                $driver->save();
                return [
                    'status' => Response::HTTP_OK,
                    'message' => "Success",
                    'data' => $driver
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
            'message' => "Driver not found",
            'data' => []
        ];
    }

    public function deleteDriver(Request $request) {
        $driver = Driver::where('driver_id', $request->driver_id)->first();
        $driver->delete();

        return [
            'status' =>Response::HTTP_OK,
            'message' => 'Success',
            'data' => $driver
        ];
    }
}
