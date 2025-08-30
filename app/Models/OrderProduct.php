<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $table = 'order_products';
    
    protected $fillable = [
        'order_id',
        'product_id',
        'supplier_id',
        'quantity',
    ];

    public function products()
    {
        return $this->belongsToMany(
            ProductProfile::class,
            'order_products',
            'order_id',     
            'product_id'    
        )
        ->withPivot('supplier_id', 'quantity')
        ->withTimestamps();
    }
}
