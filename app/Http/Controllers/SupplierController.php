<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{

    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }


    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        $supplier = new Supplier;
        $supplier->name = $request->name;
        $supplier->phone = $request->phone ?? NULL;
        $supplier->address = $request->address ?? NULL;
        $supplier->gstin = $request->gstin ?? NULL;
        $supplier->supplier_code = $request->supplier_code ?? NULL;
        $supplier->contact_person = $request->contact_person ?? NULL;
        $supplier->save();

        return response()->json($supplier);

        
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'supplier_code' => 'nullable|string|max:190',
            'contact_person' => 'nullable|string|max:190',
        ]);

        $supplier->update($request->all());

        return response()->json(['success' => true, 'message' => 'Supplier updated successfully.', 'supplier' => $supplier]);
    }

    // Delete supplier
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return response()->with('success' , 'Supplier deleted successfully.');
    }
}
