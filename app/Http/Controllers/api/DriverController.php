<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function ListDriver(Request $request){
        $drivers = Driver::all();
        return DriverResource::collection($drivers);
    }

    public function CreateDriver(Request $request){
        try{
            $driver = new Driver();
            $driver->name = $request->name;
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

    public function UpdateDriver(Request $request){

    }

    public function DeleteDriver(Request $request){

    }
}
