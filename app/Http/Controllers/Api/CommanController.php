<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductProfile;
use App\Models\Supplier;
use App\Models\Supervisor;


class CommanController extends Controller
{
    public function getProducts(){
        $products = ProductProfile::all();
        return response()->json($products);   
    }
    public function getSuppliers(){
        $suppliers = Supplier::all();
        return response()->json($suppliers);   
    }
    public function getSupervisors(){
        $supervisors = Supervisor::all();
        return response()->json($supervisors);   
    }
    public function storeOrder(Request $request){
        $request->validate([
            'grn_no' => 'required',
            'product_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'supervisor_id' => 'required|integer',
            'tar_weight' => 'nullable|numeric',
            'gross_weight' => 'nullable|numeric',
            'net_weight' => 'nullable|numeric',
        ]);

        $order = Order::create($request->only([
            'grn_no',
            'supplier_id',
            'supervisor_id',
            'tar_weight',
            'gross_weight',
            'net_weight'
        ]));
    }
}
