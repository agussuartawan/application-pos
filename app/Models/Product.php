<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Product extends Model
{
    use LogsActivity; 

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

    // acitivity log option
    protected static $logFillable = true;

    protected static $logName = 'Produk';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
    	if($eventName == 'created'){
    		$newEventName = 'menambahkan';
    	} else if($eventName == 'updated'){
    		$newEventName = 'mengubah';
    	} else if ($eventName == 'deleted'){
    		$newEventName = 'menghapus';
    	}

        return ":causer.name {$newEventName} :subject.name pada <span class='badge badge-info'>Produk</span>";
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function getWarehouseNames()
    {
        return $this->warehouse->pluck('name');
    }
}
