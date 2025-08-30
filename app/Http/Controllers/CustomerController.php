<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id', 'desc')->paginate(10); // 10 per page
        return view('customers.index', compact('customers'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'phone'=>'required|string|max:20',
    //     ]);

    //     $customer = new Customer;
    //     $customer->name = $request->name;
    //     $customer->phone = $request->phone;
    //     $customer->save();

    //     return response()->json($customer)->with('success', 'Customer added successfully.');
    // }

    

    // public function update(Request $request, $id)
    // {
        
    //     $customer = Customer::findOrFail($id);

    //     $request->validate([
    //         'name'  => 'required|string|max:255',
    //         'phone' => 'required|string|max:20',
    //     ]);

    //     $customer->update([
    //         'name'  => $request->name,
    //         'phone' => $request->phone,
    //     ]);

    //     if ($request->ajax()) {
    //         return response()->json($customer);
    //     }

    //     return redirect()->back()->with('success', 'Customer updated successfully.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Customer added successfully!',
            'customer' => $customer
        ]);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $customer->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Customer updated successfully!',
            'customer' => $customer
        ]);
    }


    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->back()->with('success', 'Customer deleted successfully.');
    }
}
