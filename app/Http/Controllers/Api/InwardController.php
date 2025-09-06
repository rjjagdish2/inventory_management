<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Inward;
use App\Models\InwardItem;
use Illuminate\Support\Facades\DB;

class InwardController extends Controller
{
    /**
     * Store a new Inward with items.
     */
    public function store(Request $request)
    {
        // ✅ Validate request
        $validated = $request->validate([
            'grn_no'        => 'required',
            'order_no'      => 'required',
            'supervisor_no' => 'required',
            'items'         => 'required',
            'items.*.supplier_id' => 'required|integer|exists:supplier,id',
            'items.*.product_id'  => 'required|integer|exists:product_profile,id',
            'items.*.category_id' => 'required|integer|exists:categories,id',
            'items.*.tare_weight'  => 'nullable|numeric',
            'items.*.gross_weight' => 'nullable|numeric',
            'items.*.net_weight'   => 'nullable|numeric',
        ]);

        DB::beginTransaction();

        try {
            // ✅ Create the main inward entry
            $inward = Inward::create([
                'grn_no'        => $validated['grn_no'],
                'order_id'      => $validated['order_no'],
                'supervisor_id' => $validated['supervisor_no'],
            ]);

            // ✅ Loop through items and create inward_items
            foreach ($validated['items'] as $item) {
                InwardItem::create([
                    'inward_id'     => $inward->id,
                    'supplier_id'   => $item['supplier_id'],
                    'product_id'    => $item['product_id'],
                    'category_id'   => $item['category_id'],
                    'tare_weight'   => $item['tare_weight'] ?? 0,
                    'gross_weight'  => $item['gross_weight'] ?? 0,
                    'net_weight'    => $item['net_weight'] ?? 0,
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Inward created successfully',
                'inward'  => $inward->load('items'),
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => 'Failed to create inward',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
