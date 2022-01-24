<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Supplier extends Model
{
    use LogsActivity;

    protected $fillable = ['name', 'address', 'phone', 'email'];

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
}
