<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Inward;
use App\Models\InwardItem;

class InwardController extends Controller
{
    public function index()
    {
        $inwards = Inward::latest()->get();
        
        return view('inward.index', compact('inwards'));
    }

    public function show($id)
    {
        $inward = Inward::with(['items.supplier', 'items.product', 'items.category'])->findOrFail($id);
        return view('inward.show', compact('inward'));
    }

}
