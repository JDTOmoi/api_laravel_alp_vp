<?php

namespace App\Http\Controllers\api;

use App\Models\Promo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PromoResource;
use Symfony\Component\HttpFoundation\Response;

class PromoController extends Controller
{
    public function ListPromo(){
        $promos = Promo::all();
        return PromoResource::collection($promos);
    }

    public function createPromo(Request $request){
        try{
            $promo = new Promo();
            $promo->name = $request->name;
            $promo->promo_code = $request->promo_code;
            $promo->promo_exp = $request->promo_exp;
            $promo->save();
            return [
                'status' => Response::HTTP_OK,
                'message' => "Success",
                'data' => $promo
            ];
        }catch(Exception $e){
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }
    }

    public function updatePromo(Request $request){
        $promo = Promo::where('promo_id', $request->promo_id)->first();

        if(!empty($promo)){
            try{
                $promo = new Promo();
                $promo->name = $request->name;
                $promo->promo_code = $request->promo_code;
                $promo->promo_exp = $request->promo_exp;
                $promo->save();
                return [
                    'status' => Response::HTTP_OK,
                    'message' => "Success",
                    'data' => $promo
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
            'message' => "Promo not found",
            'data' => []
        ];
    }
    public function deletePromo(Request $request) {
        $promo = Promo::where('promo_id', $request->promo_id)->first();
        $promo->delete();

        return [
            'status' =>Response::HTTP_OK,
            'message' => 'Success',
            'data' => $promo
        ];
    }
}
