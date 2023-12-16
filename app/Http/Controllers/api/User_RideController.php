<?php

namespace App\Http\Controllers\api;

use App\Models\Ride;
use App\Models\User;
use App\Models\Place;
use App\Models\Promo;
use App\Models\User_Ride;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User_RideResource;
use Symfony\Component\HttpFoundation\Response;

class User_RideController extends Controller
{
    public function getAllURs(){
        $urs = User_Ride::all();
        return User_RideResource::collection($urs);
    }

    public function ListURByRide(Request $request){
        $ride = Ride::where('ride_id', $request->ride_id)->first();
        $urs = $ride->urs()->get();
        return [
            'status' => Response::HTTP_OK,
            'message' => 'Success',
            'data' => User_RideResource::collection($urs)
        ];
    }

    public function ListURByPromo(Request $request){
        $promo = Promo::where('promo_id', $request->promo_id)->first();
        $urs = $promo->urs()->get();
        return [
            'status' => Response::HTTP_OK,
            'message' => 'Success',
            'data' => User_RideResource::collection($urs)
        ];
    }

    public function ListURByUser(Request $request){
        $user = User::where('user_id', $request->user_id)->first();
        $urs = $user->urs()->get();
        return [
            'status' => Response::HTTP_OK,
            'message' => 'Success',
            'data' => User_RideResource::collection($urs)
        ];
    }

    public function createUR(Request $request){
        try{
            $ur = new User_Ride();
            $ur->passanger_id = $request->passanger_id;
            $ur->review = $request->review;
            $ur->ride_id = $request->ride_id;
            $ur->promo_id = $request->promo_id;
            $ur->price = $request->price;
            $ur->save();
            return [
                'status' => Response::HTTP_OK,
                'message' => "Success",
                'data' => $ur
            ];
        }catch(Exception $e){
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }
    }

    public function updateUR(Request $request){
        $ur = User_Ride::where('ur_id', $request->ur_id)->first();

        if(!empty($ur)){
            try{
                $ur = new User_Ride();
                $ur->passanger_id = $request->passanger_id;
                $ur->review = $request->review;
                $ur->ride_id = $request->ride_id;
                $ur->promo_id = $request->promo_id;
                $ur->price = $request->price;
                $ur->save();
                return [
                    'status' => Response::HTTP_OK,
                    'message' => "Success",
                    'data' => $ur
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
            'message' => "Place not found",
            'data' => []
        ];
    }
    public function deleteUR(Request $request) {
        $ur = User_Ride::where('ur_id', $request->ur_id)->first();
        $ur->delete();

        return [
            'status' =>Response::HTTP_OK,
            'message' => 'Success',
            'data' => $ur
        ];
    }
}
