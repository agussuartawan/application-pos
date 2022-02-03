<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Wuwx\LaravelAutoNumber\AutoNumberTrait;

class Purchase extends Model
{
	use LogsActivity, AutoNumberTrait;

	protected $fillable = [
		'user_id',
		'supplier_id',
		'warehouse_id',
		'term_id',
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
		return $this->belongsToMany(Product::class, 'purchase_products')->withPivot('price', 'qty', 'discount', 'subtotal');
	}

	public function supplier()
	{
		return $this->belongsTo(Supplier::class);
	}

	public function warehouse()
	{
		return $this->belongsTo(Warehouse::class);
	}

	public function purchaseOnCredit()
	{
		return $this->belongsTo(PurchaseOnCredit::class);
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

		return ":causer.name {$newEventName} :subject.purchase_number pada <span class='badge badge-info'>Pembelian</span>";
	}

	public function getAutoNumberOptions()
	{
		return [
			'purchase_number' => [
				'format' => 'PRC/' . date('Y') . '/' . date('m') . '/' . date('d') . '-?', // autonumber format. '?' will be replaced with the generated number.
				'length' => 5, // The number of digits in an autonumber
			],
		];
	}
}
