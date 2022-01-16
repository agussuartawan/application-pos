<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'group_id',
        'unit_id',
        'warehouse_id',
        'code',
        'name',
        'slug',
        'size',
        'purchase_price',
        'selling_price',
        'min_stock',
        'max_stock',
        'photo'
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function getWarehouseNames()
    {
        return $this->warehouse->pluck('name');
    }
}
