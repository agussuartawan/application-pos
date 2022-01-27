<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use LogsActivity;

    protected $fillable = ['description', 'term_day', 'is_cash'];

    // acitivity log option
    protected static $logFillable = true;

    protected static $logName = 'Batas Kredit';

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

        return ":causer.name {$newEventName} :subject.name pada <span class='badge badge-info'>Batas Kredit</span>";
    }
}
