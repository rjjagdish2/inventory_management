<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Metal;


class MetalController extends Controller
{
    public function index()
    {

        $metals = Metal::all();
        return view('metal.index', compact('metals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Metal::create($request->all());

        return redirect()->route('metal.index')->with('success', 'Metal added successfully!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
        ]);
        $id = $request['id'];

        $metal = Metal::findOrFail($id);
        $metal->update($request->only('name'));

        return redirect()->route('metal.index')->with('success', 'Metal updated successfully!');
    }

    public function destroy(Request $request)
    {
        $id = $request['id'];
        $metal = Metal::findOrFail($id);
        $metal->delete();

        return redirect()->route('metal.index')->with('success', 'Metal deleted successfully!');
    }
}
