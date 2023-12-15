<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function ListPlace(Request $request){
        $places = Place::all();
        return PlaceResource::collection($places);
    }

    public function createPlace(Request $request){
        try{
            $place = new Place();
            $place->name = $request->name;
            $place->address = $request->address;
            $place->user_id = $request->user_id;
            $place->save();
            return [
                'status' => Response::HTTP_OK,
                'message' => "Success",
                'data' => $user
            ];
        }catch(Exception $e){
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }
    }

    public function updatePlace(Request $request){
        $place = Place::where('place_id', $request->place_id)->first();

        if(!empty($place)){
            try{
                $place = new Place();
                $place->name = $request->name;
                $place->address = $request->address;
                $place->user_id = $request->user_id;
                return [
                    'status' => Response::HTTP_OK,
                    'message' => "Success",
                    'data' => $place
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
            'message' => "User not found",
            'data' => []
        ];
    }
    public function deletePlace(Request $request) {
        $place = User::where('place_id', $request->place_id)->first();
        $place->delete();

        return [
            'status' =>Response::HTTP_OK,
            'message' => 'Success',
            'data' => $place
        ];
    }
}
