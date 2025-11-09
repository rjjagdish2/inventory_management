<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Grade;
use App\Models\Metal;

class GradeController extends Controller
{
    public function index()
    {

        $grades = Grade::with('metal')->orderBy('metal_id')->get();

        $metals= Metal::all();

        return view('grade.index', compact('grades','metals'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'metal_id' => 'required|exists:metals,id',
        ]);

        $grade = new Grade;
        $grade->name = trim($request->name);
        $grade->metal_id = trim($request->metal_id);
        $grade->save();

        return redirect()->route('grade.index')->with('success', 'Grade added successfully!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'metal_id' => 'required|exists:metals,id',
        ]);
        $id = $request['id'];

        $grade = Grade::findOrFail($id);
        $grade->name = $request->name;
        $grade->metal_id = $request->metal_id;
        $grade->save();

        return redirect()->route('grade.index')->with('success', 'Grade updated successfully!');
    }

    public function destroy(Request $request)
    {
        $id = $request['id'];
        $grade = Grade::findOrFail($id);
        $grade->delete();

        return redirect()->route('grade.index')->with('success', 'Grade deleted successfully!');
    }
}
