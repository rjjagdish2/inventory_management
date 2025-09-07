<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inward extends Model
{
    use HasFactory;

    protected $table = 'inwards';

    protected $fillable = [
        'grn_no',
        'order_id',
        'supervisor_id',
    ];

    /**
     * An inward has many inward items
     */
    public function items()
    {
        return $this->hasMany(InwardItem::class, 'inward_id');
    }
}
