<?php

namespace App\Http\Controllers;

use App\Models\Supervisor;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    // Show all supervisors
    public function index()
    {
        $supervisors = Supervisor::all();
        return view('supervisor.index', compact('supervisors'));
    }

    // Store new supervisor
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:supervisor,name',
        ]);

        Supervisor::create([
            'name' => $request->name,
        ]);

        return redirect()->route('supervisor.index')->with('success', 'Supervisor added successfully.');
    }

    // Update supervisor
    public function update(Request $request)
    {
        $request->validate([
            'id'   => 'required|exists:supervisor,id',
            'name' => 'required|string|max:255|unique:supervisor,name,' . $request->id,
        ]);

        $supervisor = Supervisor::findOrFail($request->id);
        $supervisor->update([
            'name' => $request->name,
        ]);

        return redirect()->route('supervisor.index')->with('success', 'Supervisor updated successfully.');
    }

    // Delete supervisor
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:supervisor,id',
        ]);

        Supervisor::destroy($request->id);

        return redirect()->route('supervisor.index')->with('success', 'Supervisor deleted successfully.');
    }
}
