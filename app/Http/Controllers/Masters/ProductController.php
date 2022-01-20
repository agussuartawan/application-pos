<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Product;
use App\Models\Type;
use App\Models\Unit;
use App\Models\Warehouse;
use DataTables, Auth, DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouse = Warehouse::pluck('name', 'id');
        $group = Group::pluck('name', 'id');
        $type = Type::pluck('name', 'id');
        return view('product.index', compact('warehouse', 'group', 'type'));
    }

    public function getProductList(Request $request)
    {

        $data  = Product::query();

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                $buttons = '';
                if (Auth::user()->can('lihat produk')) {
                    $buttons .= '<a class="modal-show btn-show" href="' . url('products/' . $data->id) . '/show" title="Detail ' . $data->name . '" data-name="' . $data->name . '"><i class="ik ik-eye f-16 mr-15 text-info"></i></a>';
                }
                if (Auth::user()->can('edit produk')) {
                    $buttons .= '<a class="modal-show" href="' . url('products/' . $data->id) . '/edit" title="Edit ' . $data->name . '"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>';
                }
                if (Auth::user()->can('hapus produk')) {
                    $buttons .= '<a class="btn-delete" href="' . url('products/' . $data->id) . '" title="Hapus ' . $data->name . '" data-name="' . $data->name . '"><i class="ik ik-trash-2 f-16 mr-15 text-red"></i></a>';
                }

                return '<div class="table-actions text-center">' . $buttons . '</div>';
            })
            ->filter(function ($instance) use ($request) {
                if ($request->type != NULL) {
                    $instance->where('type_id', $request->type);
                }
                if($request->group != NULL){
                    $instance->where('group_id', $request->group);
                }
                if($request->warehouse != NULL){
                    $instance->where('warehouse_id', $request->warehouse);
                }
                if (!empty($request->search)) {
                     $instance->where(function($w) use($request){
                        $search = $request->search;
                        $w->orWhere('code', 'LIKE', "%$search%")
                        ->orWhere('name', 'LIKE', "%$search%")
                        ->orWhere('size', 'LIKE', "%$search%");
                    });

                }

                return $instance;
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
        try {
            if (Auth::user()->can('tambah produk')) {
                $product = new Product();
                $warehouses = Warehouse::pluck('name', 'id');
                $groups = Group::pluck('name', 'id');
                $types = Type::pluck('name', 'id');
                $units = Unit::pluck('name', 'id');

                return view('include.product.form', compact('product', 'warehouses', 'groups', 'types', 'units'));
            } else {
                return '<div class="text-center">Anda tidak memiliki akses untuk menambah produk</div>';
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
    public function store(StoreProductRequest $request)
    {
        $purchase_price = str_replace(".", "", $request->purchase_price);
        $selling_price = str_replace(".", "", $request->selling_price);
        $model = Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'size' => $request->size,
            'purchase_price' => $purchase_price,
            'selling_price' => $selling_price,
            'min_stock' => $request->min_stock,
            'max_stock' => $request->max_stock,
            'photo' => $request->photo,
            'type_id' => $request->type_id,
            'group_id' => $request->group_id,
            'warehouse_id' => $request->warehouse_id,
            'unit_id' => $request->unit_id
        ]);
        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $created_at = $product->created_at->isoFormat('LLLL');
        $purchase_price = rupiah($product->purchase_price);
        $selling_price = rupiah($product->selling_price);
        $warehouses = Warehouse::pluck('name', 'id');
        $groups = Group::pluck('name', 'id');
        $types = Type::pluck('name', 'id');
        $units = Unit::pluck('name', 'id');
        return view('include.product.show', compact('product', 'units', 'types', 'groups', 'warehouses', 'created_at', 'purchase_price', 'selling_price'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if (Auth::user()->can('edit produk')) {
            $warehouses = Warehouse::pluck('name', 'id');
            $groups = Group::pluck('name', 'id');
            $types = Type::pluck('name', 'id');
            $units = Unit::pluck('name', 'id');
            return view('include.product.form', compact('product', 'groups', 'types', 'units', 'warehouses'));
        } else {
            return '<div class="text-center">Anda tidak memiliki akses untuk mengedit produk</div>';
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $purchase_price = str_replace(".", "", $request->purchase_price);
        $selling_price = str_replace(".", "", $request->selling_price);
        $model = $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'size' => $request->size,
            'purchase_price' => $purchase_price,
            'selling_price' => $selling_price,
            'min_stock' => $request->min_stock,
            'max_stock' => $request->max_stock,
            'photo' => $request->photo,
            'type_id' => $request->type_id,
            'group_id' => $request->group_id,
            'warehouse_id' => $request->warehouse_id,
            'unit_id' => $request->unit_id
        ]);
        return $model;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return $bug;
        }
    }

    public function getSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }

    public function searchWarehouse(Request $request)
    {
        $search = $request->search;
        return Warehouse::where('name','LIKE', "%$search%")->select('id','name')->get();
    }

    public function searchType(Request $request)
    {
        $search = $request->search;
        return Type::where('name','LIKE', "%$search%")->select('id','name')->get();
    }

    public function searchUnit(Request $request)
    {
        $search = $request->search;
        return Unit::where('name','LIKE', "%$search%")->select('id','name')->get();
    }

    public function searchGroup(Request $request)
    {
        $search = $request->search;
        return Group::where('name','LIKE', "%$search%")->select('id','name')->get();
    }
}
