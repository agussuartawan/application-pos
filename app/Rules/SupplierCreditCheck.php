<?php

namespace App\Rules;

use App\Models\Purchase;
use Illuminate\Contracts\Validation\Rule;

class SupplierCreditCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $purchases = Purchase::where('supplier_id', $value)->get();
        foreach ($purchases as $purchase) {
            if($purchase->on_credit > 0){
                $now = strtotime(\Carbon\Carbon::now()->format('Y-m-d'));
                $due_date = strtotime($purchase->due_date);
                $diff = ($now - $due_date) / 60 / 60 / 24;
                if($diff > 0){
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Anda masih memiliki hutang untuk Supplier ini, mohon lunasi terlebih dahulu!';
    }
}
