<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
	protected $table = 'product_warehouse';

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function warehouse()
	{
		return $this->belongsTo(Warehouse::class);
	}
}
