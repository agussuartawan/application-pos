<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\Stock;
use DB, DataTables;
class StockController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::orderBy('id', 'ASC')->pluck('name', 'id');
        return view('stock.index', compact('warehouses'));
    }

    public function getStockList(Request $request)
    {
        $data  = Stock::with('product');
        return Datatables::of($data)
            ->addColumn('code', function($data){
                return $data->product->code;
            })
            ->addColumn('name', function ($data) {
                return $data->product->name;
            })
            ->addColumn('location', function ($data) {
                return '<div class="badge badge-secondary">'.$data->warehouse->name.'</div>';
            })
            ->filter(function ($data) use ($request) {
                if($request->warehouse_id != NULL){
                    $data->where('warehouse_id', $request->warehouse_id);
                }
                if (!empty($request->search)) {
                    $data->join('products', 'products.id', '=','product_warehouse.product_id')->where(function($w) use ($request){
                        $search = $request->search;
                        $w->orWhere('code', 'LIKE', "%$search%")
                        ->orWhere('name', 'LIKE', "%$search%");
                    });
                }

                return $data;
            })
            ->rawColumns(['code','name','location'])
            ->make(true);
    }
}
