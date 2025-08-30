<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Grade;

class GradeController extends Controller
{
    public function index()
    {
        
        $grades = Grade::all();
        return view('grade.index', compact('grades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Grade::create($request->all());

        return redirect()->route('grade.index')->with('success', 'Grade added successfully!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
        ]);
        $id = $request['id'];

        $grade = Grade::findOrFail($id);
        $grade->update($request->only('name'));

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
