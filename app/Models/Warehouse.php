<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use LogsActivity, Sluggable, SoftDeletes;

    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];

    // acitivity log option
    protected static $logFillable = true;

    protected static $logName = 'Gudang';

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

        return ":causer.name {$newEventName} :subject.name pada <span class='badge badge-info'>Gudang</span>";
    }

    public function product()
    {
        return $this->belongsToMany(Product::class, 'stocks')->withPivot('in_stock');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
