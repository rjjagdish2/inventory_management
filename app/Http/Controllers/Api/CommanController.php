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
        $orderIds = Order::get()->pluck('id');
        return response()->json([
            'status' => 'success',
            'order_ids' => $orderIds
        ]);
        // return response()->json($orders);
    }
    public function getOrderDetails($orderId){
        try {
            
            if(!isset($orderId) && !empty($orderId)){
                return response()->json([
                    "status"=>"error",
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
                    "status" => "error",
                    "message" => "Order not found"
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                "message"=>"Order Details",
                'order_ids' => $data
            ]);
        }catch (ModelNotFoundException $e) {
            return response()->json([
                "status" => "error",
                "message" => "Order not found"
            ], 404);
        }
        // return response()->json($data);
    }
    
    public function addInwards(Request $request){
        
    }
}
