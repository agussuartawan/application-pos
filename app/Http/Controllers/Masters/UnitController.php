<?php

namespace App\Http\Controllers\Masters;

use App\Models\Unit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables, Auth;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product-unit.index');        
    }

    public function getProductUnitList()
    {
        $data  = Unit::orderBy('created_at', 'DESC')->get();

        return Datatables::of($data)
                ->addColumn('action', function($data){
                    if (Auth::user()->can('mengelola unit produk')){
                        return '<div class="table-actions">
                                <a class="btn-edit" href="'.url('product-units/'.$data->id).'/edit" title="Edit '.$data->name.'"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                <a class="btn-delete" href="'.url('product-units/'.$data->id).'" title="Hapus '.$data->name.'" data-name="'.$data->name.'"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                            </div>';
                    }else{
                        return '';
                    }
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
            'name.required' => 'Nama unit tidak boleh kosong!'
        ];
        $this->validate($request, [
            'name' => 'required|max:255'
        ], $messages);

        $model = Unit::create($request->all());
        return $model;
    }

    public function showForm()
    {
        try{
            $product_unit = new Unit();
            return view('include.product-unit.form', compact('product_unit'));
        } catch (\Exception $e){
            $bug = $e->getMessage();
            return $bug;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $product_unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $product_unit)
    {
        return view('include.product-unit.form', compact('product_unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $product_unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $product_unit)
    {
        $messages = [
            'name.required' => 'Nama unit tidak boleh kosong!'
        ];
        $this->validate($request, [
            'name' => 'required|max:255'
        ], $messages);

        $model = $product_unit->update($request->all());
        return $model;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $product_unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $product_unit)
    {
        try{
            $product_unit->delete();
        } catch(\Exception $e){
            $bug = $e->getMessage();
            return $bug;
        }
    }
}
