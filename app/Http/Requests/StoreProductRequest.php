<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            // 'code' => 'min:3|max:50|unique:products,code',
            'name' => 'required|max:255',
            'slug' => 'required',
            'size' => 'required|integer|unique:products,slug',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'min_stock' => 'required|integer',
            'max_stock' => 'required|integer',
            'photo' => 'image',
            'type_id' => 'required',
            'unit_id' => 'required',
            'group_id' => 'required',
            'warehouse_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Kode produk tidak boleh kosong.',
            'code.min' => 'Kode harus terdiri dari minimal 3 digit.',
            'code.max' => 'Kode harus terdiri dari maksimal 50 digit.',
            'name.required' => 'Nama tidak boleh kosong.',
            'name.max' => 'Nama harus terdiri dari maksimal 255 kata.',
            'slug.required' => 'Slug tidak boleh kosong.',
            'size.required' => 'Ukuran tidak boleh kosong.',
            'size.integer' => 'Ukuran harus angka.',
            'purchase_price.required' => 'Harga beli tidak boleh kosong.',
            'purchase_price.numeric' => 'Harga beli harus numerik.',
            'selling_price.required' => 'Harga jual tidak boleh kosong.',
            'selling_price.numeric' => 'Harga jual harus numerik.',
            'min_stock.required' => 'Stok minimum tidak boleh kosong.',
            'min_stock.integer' => 'Stok minimum harus angka.',
            'max_stock.required' => 'Stok maksimum tidak boleh kosong.',
            'max_stock.integer' => 'Stok maksimum harus angka.',
            'photo.image' => 'Format gambar tidak sesuai.',
            'type_id.required' => 'Tipe produk tidak boleh kosong.',
            'unit_id.required' => 'Unit produk tidak boleh kosong.',
            'group_id.required' => 'Grup produk tidak boleh kosong.',
            'warehouse_id.required' => 'Gudang tidak boleh kosong.',
        ];
    }
}
