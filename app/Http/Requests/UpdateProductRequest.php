<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            // 'code' => 'required|min:3|max:50|unique:products,code,'. $this->product->id,
            'name' => 'required|max:255',
            'slug' => 'required|unique:products,slug,' . $this->product->id,
            'size' => 'required|integer',
            'purchase_price' => 'required',
            'selling_price' => 'required',
            'photo' => 'image',
            'type_id' => 'required',
            'unit_id' => 'required',
            'group_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            // 'code.required' => 'Kode produk tidak boleh kosong.',
            // 'code.min' => 'Kode harus terdiri dari minimal 3 digit.',
            // 'code.max' => 'Kode harus terdiri dari maksimal 50 digit.',
            // 'code.unique' => 'Kode sudah digunakan',
            'name.required' => 'Nama tidak boleh kosong.',
            'name.max' => 'Nama harus terdiri dari maksimal 255 kata.',
            'slug.required' => 'Slug tidak boleh kosong.',
            'size.required' => 'Ukuran tidak boleh kosong.',
            'size.integer' => 'Ukuran harus angka.',
            'slug.unique' => 'Slug sudah digunakan',
            'purchase_price.required' => 'Harga beli tidak boleh kosong.',
            'selling_price.required' => 'Harga jual tidak boleh kosong.',
            'photo.image' => 'Format gambar tidak sesuai.',
            'type_id.required' => 'Tipe produk tidak boleh kosong.',
            'unit_id.required' => 'Unit produk tidak boleh kosong.',
            'group_id.required' => 'Grup produk tidak boleh kosong.',
        ];
    }
}
