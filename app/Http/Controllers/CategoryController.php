<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Show all categories
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Store a new category
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Category added successfully!');
    }

    /**
     * Update category
     */
    public function update(Request $request)
    {
        $request->validate([
            'id'   => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:categories,name,' . $request->id,
        ]);

        $category = Category::findOrFail($request->id);
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    /**
     * Delete category
     */
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:categories,id',
        ]);

        $category = Category::findOrFail($request->id);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully!');
    }
}
