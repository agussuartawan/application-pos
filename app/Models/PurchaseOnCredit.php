<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOnCredit extends Model
{
	protected $fillable = ['purchase_id', 'total_credit', 'is_pai'];
}
