<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductProfile;
use App\Models\Supplier;
use App\Models\Order;
use App\Models\Supervisor;


class CommanController extends Controller
{
    
    public function getOrders(){
        try{
            $orderIds = Order::get()->pluck('id');
            return response()->json([
                'success' => false,
                'order_ids' => $orderIds
            ],200);
        }catch(Exception $e){
            return response()->json([
                'success'=>false,
                'message'=>'something went wrong!'
            ], 500);
        }
        
        // return response()->json($orders);
    }
    public function getOrderDetails($orderId){
        try {
            
            if(!isset($orderId) && !empty($orderId)){
                return response()->json([
                    "success"=>false,
                    "message"=>"Order Id is required"
                ],422);
            }
            $data = Order::with([
                'customer', 
                'products', 
                'products.suppliers'
            ])->find($orderId);

            if(!$data){
                return response()->json([
                    "success" => false,
                    "message" => "Order not found"
                ], 404);
            }

            return response()->json([
                'success' => true,
                "message"=>"Order Details",
                'order_ids' => $data
            ]);
        }catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Something went wrong"
            ], 500);
        }
        // return response()->json($data);
    }
    
    public function addInwards(Request $request){

    }
}
