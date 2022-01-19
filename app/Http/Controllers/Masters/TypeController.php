<?php

namespace App\Http\Controllers\Masters;

use App\Models\Type;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables, Auth;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product-type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductTypeList()
    {
        $data  = Type::orderBy('created_at', 'DESC')->get();

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                $buttons = '';
                if (Auth::user()->can('edit tipe produk')) {
                    $buttons .= '<a class="btn-edit" href="' . url('product-types/' . $data->id) . '/edit" title="Edit ' . $data->name . '"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>';
                }
                if (Auth::user()->can('hapus tipe produk')) {
                    $buttons .= '<a class="btn-delete" href="' . url('product-types/' . $data->id) . '" title="Hapus ' . $data->name . '" data-name="' . $data->name . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>';
                }

                return '<div class="table-actions">' . $buttons . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Nama tipe tidak boleh kosong!'
        ];
        $this->validate($request, [
            'name' => 'required|max:255'
        ], $messages);

        $model = Type::create($request->all());
        return $model;
    }

    public function showForm()
    {
        try {
            if (Auth::user()->can('tambah tipe produk')) {
                $product_type = new Type();
                return view('include.product-type.form', compact('product_type'));
            } else {
                return '<div class="text-center">Anda tidak memiliki akses untuk menambah tipe produk</div>';
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return $bug;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type  $product_type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $product_type)
    {
        if (Auth::user()->can('edit tipe produk')) {
            return view('include.product-type.form', compact('product_type'));
        } else {
            return '<div class="text-center">Anda tidak memiliki akses untuk mengedit tipe produk</div>';
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $product_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $product_type)
    {
        $messages = [
            'name.required' => 'Nama tipe tidak boleh kosong!'
        ];
        $this->validate($request, [
            'name' => 'required|max:255'
        ], $messages);

        $model = $product_type->update($request->all());
        return $model;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $product_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $product_type)
    {
        try {
            $product_type->delete();
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return $bug;
        }
    }
}
