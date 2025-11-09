<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductProfile;
use App\Models\ProductSupplier;
use App\Models\Supplier;
use App\Models\Category;

class ProductController extends Controller
{
    public function getBySupplier($supplierId){
        $productsSuplier = ProductSupplier::where('supplier_id', $supplierId)->get('product_id')->toArray();
        
        $products = ProductProfile::whereIn('id',$productsSuplier)->get();
        
        return response()->json($products);
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'supplier_id' => 'required',
            'name' => 'required',
            
        ]);

        $filePath = "";
        if ($request->hasFile('design')) {
            $filePath = $request->file('design')->store('uploads', 'public');
        }

        $product = new ProductProfile;
        $product->name = $request->name;
        $product->item_code = $request->code ?? NULL;
        $product->size = $request->size ?? NULL;
        $product->grade = $request->grade_id ?? NULL;
        $product->castig_ratio = $request->castingRatio ?? NULL;
        $product->qty = 0;
        $product->design = $filePath;
        $product->category_id = $request->category_id;
        $product->save();


        $productSuplier = new ProductSupplier;
        $productSuplier->product_id = $product->id;
        $productSuplier->supplier_id = $request->supplier_id;
        $productSuplier->save();

        
        return response()->json($product);
    }

    // Show product profiles page
    public function index()
    {
        $products = ProductProfile::with('supplierRelation.supplier','gradeRelation','category')->get();
        $suppliers = Supplier::all();
        $metals = \App\Models\Metal::has('grades')->get();

        $grades = \App\Models\Grade::all(); // assuming you have a Grade model
        $categories = \App\Models\Category::all();

        return view('product_profiles.index', compact('products', 'suppliers', 'grades','categories','metals'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_id' => 'required',
            'name' => 'required',
        ]);

        $product = ProductProfile::findOrFail($id);

        // Handle file upload if a new design is provided
        if ($request->hasFile('design')) {
            // Optionally delete old file
            if ($product->design && \Storage::disk('public')->exists($product->design)) {
                \Storage::disk('public')->delete($product->design);
            }
            $filePath = $request->file('design')->store('uploads', 'public');
            $product->design = $filePath;
        }

        $product->name = $request->name;
        $product->item_code = $request->code ?? $product->item_code;
        $product->size = $request->size ?? $product->size;
        $product->grade = $request->grade_id ?? $product->grade;
        $product->castig_ratio = $request->castingRatio ?? $product->castig_ratio;
        $product->category_id = $request->category_id ?? $product->category_id;
        $product->save();

        // Update supplier relation
        $productSupplier = ProductSupplier::where('product_id', $product->id)->first();
        if ($productSupplier) {
            $productSupplier->supplier_id = $request->supplier_id;
            $productSupplier->save();
        } else {
            // If somehow missing, create new relation
            ProductSupplier::create([
                'product_id' => $product->id,
                'supplier_id' => $request->supplier_id,
            ]);
        }

        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = ProductProfile::findOrFail($id);

        // Delete associated design file if exists
        if ($product->design && \Storage::disk('public')->exists($product->design)) {
            \Storage::disk('public')->delete($product->design);
        }

        // Delete the supplier relation if exists
        $product->supplierRelation()->delete();

        // Delete the product
        $product->delete();

        // Return JSON response for AJAX
        return redirect()->back()->with('success' , 'Product deleted successfully.');
    }

    public function getCategoryFromProduct($id){
        $category_id = ProductProfile::whereId($id)->get('category_id')->first();
        $category = Category::whereId($category_id->category_id)->first();
        return response()->json($category);
    }


}
