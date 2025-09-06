<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InwardItem extends Model
{
    use HasFactory;

    protected $table = 'inward_items';

    protected $fillable = [
        'inward_id',
        'supplier_id',
        'product_id',
        'category_id',
        'tare_weight',
        'gross_weight',
        'net_weight',
    ];

    /**
     * Belongs to an Inward
     */
    public function inward()
    {
        return $this->belongsTo(Inward::class, 'inward_id');
    }

    /**
     * Belongs to a Supplier
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    /**
     * Belongs to a Product
     */
    public function product()
    {
        return $this->belongsTo(ProductProfile::class, 'product_id');
    }

    /**
     * Belongs to a Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
