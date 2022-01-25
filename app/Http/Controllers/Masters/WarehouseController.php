<?php

namespace App\Http\Controllers\Masters;

use App\Models\Warehouse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables, Auth;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('warehouse.index');
    }

    public function getWarehouseList()
    {
        $data  = Warehouse::orderBy('created_at', 'DESC')->get();

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                $buttons = '';
                if (Auth::user()->can('edit gudang')) {
                    $buttons .= '<a class="btn-edit" href="' . url('warehouses/' . $data->id) . '/edit" title="Edit ' . $data->name . '"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>';
                }
                if (Auth::user()->can('hapus gudang')) {
                    $buttons .= '<a class="btn-delete" href="' . url('warehouses/' . $data->id) . '" title="Hapus ' . $data->name . '" data-name="' . $data->name . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>';
                }

                return '<div class="table-actions text-center">' . $buttons . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showForm()
    {
        try {
            if (Auth::user()->can('tambah gudang')) {
                $warehouse = new Warehouse();
                return view('include.warehouse.form', compact('warehouse'));
            } else {
                return '<div class="text-center">Anda tidak memiliki akses untuk menambah gudang</div>';
            }
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
            'name.required' => 'Nama gudang tidak boleh kosong!'
        ];
        $this->validate($request, [
            'name' => 'required|max:255'
        ], $messages);

        $model = Warehouse::create($request->all());
        return $model;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        if (Auth::user()->can('edit gudang')) {
            return view('include.warehouse.form', compact('warehouse'));
        } else {
            return '<div class="text-center">Anda tidak memiliki akses untuk mengedit gudang</div>';
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $messages = [
            'name.required' => 'Nama gudang tidak boleh kosong!'
        ];
        $this->validate($request, [
            'name' => 'required|max:255'
        ], $messages);

        $model = $warehouse->update($request->all());
        return $model;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        try {
            $warehouse->delete();
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return $bug;
        }
    }

    public function searchWarehouse(Request $request)
    {
        $search = $request->search;
        return Warehouse::where('name', 'LIKE', "%$search%")->select('id', 'name')->get();
    }
}
