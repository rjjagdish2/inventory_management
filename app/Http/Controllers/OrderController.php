<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Grade;
use App\Models\Customer;
use App\Models\OrderProduct;

class OrderController extends Controller
{

    public function index(){
        $orders = Order::with('customer')->orderBy('id', 'desc')->paginate(10);
        
        return view('orders.index',compact('orders'));
    }

    public function details($id){
        // $order = Order::with('customer')->where('id',$id)->first();
        // $orderProducts = OrderProducts::where('order_id',$order->id);
        // $productIds = $orderProducts->pluck('product_id');
        // $supplierIds = $orderProducts->pluck('supplier_id');
        // $orderProducts = $orderProducts->all();

        // $products = ProductProfile::whereIn('id',$productIds)->get();
        // $suppliers = Supplier::whereIn('id',$supplierIds)->get();
        $order = Order::with([
            'customer', 
            'products', 
            'products.suppliers',
            'products.category'
        ])->findOrFail($id);

        
        return view('orders.order_details',compact('order'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $grades = Grade::all();
        $customers = Customer::all();
        return view('orders.create', compact('suppliers','customers','grades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'grn_no'=>'required',
            'customer_id' => 'required',
            'items' => 'required',
        ]);

        $order = Order::create([
            // 'grn_no'=>$request->grn_no,
            'customer_id' => $request->customer_id,
            'description' => $request->description,
        ]);

        $items = json_decode($request->items, true);
        
        foreach($items as $item){
            
            $orderProduct = new OrderProduct;
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $item['product_id'];
            $orderProduct->product_id = $item['category_id'];
            $orderProduct->supplier_id = $item['supplier_id'];
            $orderProduct->quantity = $item['quantity'];
            $orderProduct->save();
        }
        

        return redirect()->back()->with('success', 'Order created successfully!');
    }

    public function delete($id){
        Order::where('id',$id)->delete();

        return redirect()->route('order.index');
    }

    public function printPdf(){
        
    }
}
