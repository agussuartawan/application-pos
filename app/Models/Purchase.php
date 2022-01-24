<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
	protected $fillable = [
		'user_id',
		'supplier_id',
		'warehouse_id',
		'purchase_number',
		'purchase_invoice_number',
		'date',
		'due_date',
		'terms',
		'total',
		'status',
	];

	public function product()
	{
		return $this->belongsToMany(Product::class)->withPivot('price', 'qty', 'discount', 'subtotal');
	}

	public function supplier()
	{
		return $this->belongsTo(Supplier::class);
	}
}
