<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
	use LogsActivity;

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

	// acitivity log option
	protected static $logFillable = true;

	protected static $logName = 'Pembelian';

	protected static $logOnlyDirty = true;

	public function getDescriptionForEvent(string $eventName): string
	{
		if ($eventName == 'created') {
			$newEventName = 'menambahkan';
		} else if ($eventName == 'updated') {
			$newEventName = 'mengubah';
		} else if ($eventName == 'deleted') {
			$newEventName = 'menghapus';
		}

		return ":causer.name {$newEventName} :subject.name pada <span class='badge badge-info'>Pembelian</span>";
	}
}
