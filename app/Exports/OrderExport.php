<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromArray, WithHeadings
{
    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function array(): array
    {
        $data = [];

        foreach ($this->order->products as $product) {
            foreach ($product->suppliers as $supplier) {
                $data[] = [
                    'Order ID'    => $this->order->id,
                    'Customer'    => $this->order->customer->name ?? 'N/A',
                    'Product'     => $product->name,
                    'Quantity'    => $product->pivot->quantity ?? 1,
                    'Supplier'    => $supplier->name ?? 'N/A',
                    'Supplier Email' => $supplier->email ?? 'N/A',
                ];
            }
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Customer',
            'Product',
            'Quantity',
            'Supplier',
            'Supplier Email',
        ];
    }
}
