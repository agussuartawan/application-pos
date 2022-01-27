<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Term;
use App\Models\Warehouse;
use DataTables, Auth, DB;

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
        return view('purchase.create');
    }


    public function showFromCreate(Request $request)
    {
        $row = $request->row;
        return view('include.transaction.purchase.form-create', compact('row'));
    }

    public function store(Request $request)
    {
    	DB::transaction(function () use ($request) {
    		$total = 0;

	        // hapus nilai product_id yang kosong pada form
	        $product['product_id'] = $request->product_id;
	        $product['qty'] = $request->qty;
	        $product['price'] = $request->price;
	        $product['discount'] = $request->discount;
	        foreach ($product['product_id'] as $key => $value) {
	            if($value != null){
		            $qty = $product['qty'][$key];
		            $price = str_replace(".", "", $product['price'][$key]);
		            $discount = $product['discount'][$key] / 100;
		            $discount_rp = ($qty * $price) * $discount;
		            $product['subtotal'][$key] = ($qty * $price) - $discount_rp;
		            $total = $total + $product['subtotal'][$key];
	            }

	            if ($value == null) {
	                unset($product['product_id'][$key]);
	                unset($product['qty'][$key]);
	                unset($product['price'][$key]);
	                unset($product['discount'][$key]);
	                unset($product['subtotal'][$key]);
	            }
	        }

	        // insert ke table purchase
	        $terms = Term::where('id', $request->terms)->pluck('is_cash')->first();
	        $status = ($terms == '1') ? 'Lunas' : 'Belum Lunas';

	        $purchase = Purchase::create([
	        	'user_id' => Auth::user()->id,
	        	'supplier_id' => $request->supplier_id,
	        	'warehouse_id' => $request->warehouse_id,
	        	'date' => $request->date,
	        	'due_date' => $request->due_date,
	        	'purchase_invoice_number' => $request->purchase_invoice_number,
	        	'terms' => $terms,
	        	'status' => $status,
	        	'total' => $total
	        ]);

	        // insert to product_purchase
	        $purchase->product()->attach($product['product_id'] ,[
	        	'qty' => $product['qty'],
	        	'price' => $product['price'],
	        	'discount' => $product['discount'],
	        	'subtotal' => $product['subtotal']
	        ]);

	        // insert to purchase on credit table
	        $purchase->purchaseOnCredit()->create([
	        	'total_credit' => $purchase->total
	        ]);

	        // update in_stock di tabel product warehouse
	        $stocks = Stock::where('warehouse_id', $request->warehouse_id)
	        		->whereIn('product_id', $product['product_id'])->get();
	        foreach ($stocks as $key => $stock) {
	        	$in_stock = $stock->in_stock + (int) $product['qty']['key'];
	        	$stock->update(['in_stock' => $in_stock]);
	        }
		});
    }

    // public function countSubtotal(Request $request)
    // {
    // 	$new_price = str_replace(".", "", $request->price);
    // 	$qty = $request->qty;
    // 	$discount = $request->discount / 100;

    // 	if($request->price){
    // 		$discount_rp = $new_price * $discount;
    //  	$subtotal = ($new_price - $discount_rp) * $qty;
    // 	} else {
    // 		$subtotal = 0;
    // 	}

    // 	return rupiah($subtotal);
    // }
}
