<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use LogsActivity,SoftDeletes, Sluggable;

    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];

    // acitivity log option
    protected static $logFillable = true;

    protected static $logName = 'Unit Produk';

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

        return ":causer.name {$newEventName} :subject.name pada <span class='badge badge-info'>Unit Produk</span>";
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
