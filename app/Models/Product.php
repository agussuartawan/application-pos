<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Wuwx\LaravelAutoNumber\AutoNumberTrait;


class Product extends Model
{
    use LogsActivity, SoftDeletes, Sluggable, AutoNumberTrait;

    protected $fillable = [
        'type_id',
        'group_id',
        'unit_id',
        'name',
        'slug',
        'size',
        'purchase_price',
        'selling_price',
        'photo'
    ];

    protected $dates = ['deleted_at'];

    // acitivity log option
    protected static $logFillable = true;

    protected static $logName = 'Produk';

    protected static $logOnlyDirty = true;

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        if ($eventName == 'created') {
            $newEventName = 'menambahkan';
        } else if ($eventName == 'updated') {
            $newEventName = 'mengubah';
        } else if ($eventName == 'deleted') {
            $newEventName = 'menghapus';
        }

        return ":causer.name {$newEventName} :subject.name pada <span class='badge badge-info'>Produk</span>";
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'CK-?', // autonumber format. '?' will be replaced with the generated number.
                'length' => 5, // The number of digits in an autonumber
            ],
        ];
    }
}
