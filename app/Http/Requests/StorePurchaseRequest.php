<?php

namespace App\Http\Requests;

use App\Rules\ArrayAtLeastOne;
use App\Rules\SupplierCreditCheck;
use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'supplier_id' => [new SupplierCreditCheck(), 'required'],
            'terms' => ['required'],
            'warehouse_id' => ['required'],
            'date' => ['required'],
            'due_date' => ['required'],
            'product_id' => [new ArrayAtLeastOne()],
            'qty' => [new ArrayAtLeastOne()],
            'price' => [new ArrayAtLeastOne()],
            'discount' => [new ArrayAtLeastOne()],
        ];
    }

    public function messages()
    {
        return [
            'supplier_id.required' => 'Supplier tidak boleh kosong',
            'terms.required' => 'Batas kredit tidak boleh kosong',
            'warehouse_id.required' => 'Gudang tidak boleh kosong',
            'date.required' => 'Tanggal tidak boleh kosong',
            'due_date.required' => 'Tanggal jatuh tempo tidak boleh kosong',
        ];
    }
}
