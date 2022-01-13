<?php

namespace App;

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
}
