<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductProfile extends Model
{
    use HasFactory;

    protected $table = 'product_profile'; // table name
    
    protected $fillable = [
        'name',
        'size',
        'grade',
        'castig_ratio',
        'design',
        'item_code'
    ];
    
    /**
     * Relation: A product can have many suppliers through order_products
     */
    public function suppliers()
    {
        return $this->belongsToMany(
            Supplier::class,
            'order_products',   // pivot table
            'product_id',       // foreign key for ProductProfile
            'supplier_id'       // foreign key for Supplier
        )
        ->withPivot('order_id', 'quantity')
        ->withTimestamps();
    }

    public function supplierRelation()
    {
        return $this->hasOne(ProductSupplier::class, 'product_id');
    }

    public function gradeRelation() {
        return $this->belongsTo(\App\Models\Grade::class, 'grade', 'id');
    }

    /**
     * Relation: A product belongs to many orders through order_products
     */
    public function orders()
    {
        return $this->belongsToMany(
            Order::class,
            'order_products',   // pivot table
            'product_id',       // foreign key for ProductProfile
            'order_id'          // foreign key for Order
        )
        ->withPivot('supplier_id', 'quantity')
        ->withTimestamps();
    }
}
