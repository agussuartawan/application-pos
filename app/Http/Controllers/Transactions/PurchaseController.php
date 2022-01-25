<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Warehouse;
use DataTables, Auth;

class PurchaseController extends Controller
{
    public function index()
    {
        return view('purchase.index');
    }

    public function getPurchaseList(Request $request)
    {
        $data  = Purchase::with('supplier');

        return Datatables::of($data)
            ->addColumn('supplier_name', function ($data) {
                return $data->supplier->name;
            })
            ->addColumn('action', function ($data) {
                $buttons = '';
                if (Auth::user()->can('lihat pembelian')) {
                    $buttons .= '<a class="modal-show btn-show" href="' . url('products/' . $data->id) . '/show" title="Detail ' . $data->name . '" data-name="' . $data->name . '"><i class="ik ik-eye f-16 mr-15 text-info"></i></a>';
                }
                if (Auth::user()->can('edit pembelian')) {
                    $buttons .= '<a class="modal-show" href="' . url('products/' . $data->id) . '/edit" title="Edit ' . $data->name . '"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>';
                }

                return '<div class="table-actions text-center">' . $buttons . '</div>';
            })
            ->filter(function ($instance) use ($request) {
                // if ($request->type != NULL) {
                //     $instance->where('type_id', $request->type);
                // }
                // if ($request->group != NULL) {
                //     $instance->where('group_id', $request->group);
                // }
                // if ($request->warehouse != NULL) {
                //     $instance->where('warehouse_id', $request->warehouse);
                // }
                if (!empty($request->search)) {
                    $instance->join('supplier', 'supplier.id', '=', 'purchase.supplier_id')->where(function ($w) use ($request) {
                        $search = $request->search;
                        $w->orWhere('name', 'LIKE', "%$search%");
                    });
                }

                return $instance;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $suppliers = Supplier::pluck('name', 'id');
        $warehouses = Warehouse::pluck('name', 'id');
        return view('purchase.create', compact('suppliers', 'warehouses'));
    }


    public function showFromCreate(Request $request)
    {
        $products = Product::pluck('name', 'id');
        $row = $request->row;
        return view('include.transaction.form-create', compact('products', 'row'));
    }
}
