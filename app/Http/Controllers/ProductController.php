<?php

namespace App\Http\Controllers;

use App\Product;
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

    public function getProductList(Request $request)
    {
        
        $data  = Product::get();

        return Datatables::of($data)
                // ->addColumn('roles', function($data){
                //     $roles = $data->getRoleNames()->toArray();
                //     $badge = '';
                //     if($roles){
                //         $badge = implode(' , ', $roles);
                //     }

                //     return $badge;
                // })
                // ->addColumn('permissions', function($data){
                //     $roles = $data->getAllPermissions();
                //     $badges = '';
                //     foreach ($roles as $key => $role) {
                //         $badges .= '<span class="badge badge-dark m-1">'.$role->name.'</span>';
                //     }

                //     return $badges;
                // })
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
                ->rawColumns(['action'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
