<?php

namespace App\Http\Controllers;

use App\Warehouse;
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
        $data  = Warehouse::get();

        return Datatables::of($data)
                ->addColumn('action', function($data){
                    if (Auth::user()->can('mengelola gudang')){
                        return '<div class="table-actions">
                                <a class="btn-edit" href="'.url('warehouse/'.$data->id).'/edit" title="Edit '.$data->name.'"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                <a class="btn-delete" href="'.url('warehouse/'.$data->id).'" title="Hapus '.$data->name.'"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                            </div>';
                    }else{
                        return '';
                    }
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
        try{
            $warehouse = new Warehouse();
            return view('include.warehouse.form', compact('warehouse'));
        } catch (\Exception $e){
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
        return view('include.warehouse.form', compact('warehouse'));
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
        //
    }
}
