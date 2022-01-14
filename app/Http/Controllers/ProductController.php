<?php

namespace App\Http\Controllers;

use App\Group;
use App\Product;
use App\Type;
use App\Unit;
use App\Warehouse;
use DataTables, Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index');
    }

    public function getProductList()
    {
        
        $data  = Product::get();

        return Datatables::of($data)
                ->addColumn('location', function($data){
                    $warehouses = $data->getWarehouseNames()->toArray();
                    $badge = '';
                    if($warehouses){
                        $badge = implode(' , ', $warehouses);
                    }

                    return $badge;
                })
                ->addColumn('action', function($data){
                    if (Auth::user()->can('mengelola produk')){
                        return '<div class="table-actions">
                                <a href="'.url('product/'.$data->id).'/edit" ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                <a href="'.url('product/'.$data->id).'"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                            </div>';
                    }else{
                        return '';
                    }
                })
                ->rawColumns(['location','action'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try
        {
            return view('product.create');

        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function showForm()
    {
        try{
            $warehouses = Warehouse::pluck('name','id');
            $types = Type::pluck('name','id');
            $groups = Group::pluck('name','id');
            $units = Unit::pluck('name','id');
            return view('include.product.form', compact('warehouses','types','groups','units'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
