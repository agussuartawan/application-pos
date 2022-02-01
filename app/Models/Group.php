<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
	use LogsActivity, Sluggable;

    protected $fillable = ['name', 'type_id'];

    protected $dates = ['deleted_at'];

    // acitivity log option
    protected static $logFillable = true;

    protected static $logName = 'Grup Produk';

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

        return ":causer.name {$newEventName} :subject.name pada <span class='badge badge-info'>Grup Produk</span>";
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
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
