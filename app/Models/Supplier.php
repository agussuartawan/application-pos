<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use LogsActivity, Sluggable, SoftDeletes;

    protected $fillable = ['name', 'address', 'phone', 'email', 'identification_type', 'identification_number'];

    // acitivity log option
    protected static $logFillable = true;

    protected static $logName = 'Supplier';

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

        return ":causer.name {$newEventName} :subject.name pada <span class='badge badge-info'>Supplier</span>";
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
