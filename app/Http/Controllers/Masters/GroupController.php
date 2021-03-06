<?php

namespace App\Http\Controllers\Masters;

use App\Models\Group;
use App\Models\Type;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables, Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product-group.index');
    }

    public function getProductGroupList()
    {
        try {
            $data  = Group::orderBy('created_at', 'DESC')->get();

            return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    $buttons = '';
                    if (Auth::user()->can('edit grup produk')) {
                        $buttons .= '<a class="btn-edit" href="' . url('product-groups/' . $data->id) . '/edit" title="Edit ' . $data->name . '"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>';
                    }
                    if (Auth::user()->can('hapus grup produk')) {
                        $buttons .= '<a class="btn-delete" href="' . url('product-groups/' . $data->id) . '" title="Hapus ' . $data->name . '" data-name="' . $data->name . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>';
                    }

                    return '<div class="table-actions text-center">' . $buttons . '</div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return $bug;
        }
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
            'name.required' => 'Nama grup tidak boleh kosong!',
            'type_id.required' => 'Tipe tidak boleh kosong'
        ];
        $this->validate($request, [
            'name' => 'required|max:255',
            'type_id' => 'required'
        ], $messages);

        $model = Group::create($request->all());
        return $model;
    }

    public function showForm()
    {
        try {
            if (Auth::user()->can('tambah grup produk')) {
                $product_group = new Group();
                $types = Type::pluck('name', 'id');
                return view('include.product-group.form', compact('product_group', 'types'));
            } else {
                return '<div class="text-center">Anda tidak memiliki akses untuk menambah grup produk</div>';
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return $bug;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $product_group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $product_group)
    {
        if (Auth::user()->can('edit grup produk')) {
            $types = Type::pluck('name', 'id');
            return view('include.product-group.form', compact('product_group', 'types'));
        } else {
            return '<div class="text-center">Anda tidak memiliki akses untuk mengedit grup produk</div>';
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $product_group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $product_group)
    {
        $messages = [
            'name.required' => 'Nama grup tidak boleh kosong!'
        ];
        $this->validate($request, [
            'name' => 'required|max:255'
        ], $messages);

        $model = $product_group->update($request->all());
        return $model;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $product_group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $product_group)
    {
        try {
            $product_group->delete();
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return $bug;
        }
    }
}
