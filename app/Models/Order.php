<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'customer_id',
        'order_date',
        'description',
        'grn_no',
        
    ];

    // 🔗 An Order belongs to a Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // 🔗 An Order has many Products through pivot table order_products
    public function products()
    {
        return $this->belongsToMany(
            ProductProfile::class,   // target model
            'order_products',        // pivot table
            'order_id',              // FK for Order
            'product_id'             // FK for ProductProfile
        )
        ->withPivot('supplier_id', 'quantity','category_id')
        ->withTimestamps();
    }
}
