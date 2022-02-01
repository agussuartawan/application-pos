<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Product;
use App\Models\Type;
use App\Models\Unit;
use App\Models\Stock;
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
        $group = Group::pluck('name', 'id');
        $type = Type::pluck('name', 'id');
        return view('product.index', compact('group', 'type'));
    }

    public function getProductList(Request $request)
    {

        $data  = Product::query();

        return Datatables::of($data)
            ->addColumn('selling_price', function ($data) {
                return 'Rp. ' . rupiah($data->selling_price);
            })
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
                if ($request->group != NULL) {
                    $instance->where('group_id', $request->group);
                }
                if ($request->warehouse != NULL) {
                    $instance->where('warehouse_id', $request->warehouse);
                }
                if (!empty($request->search)) {
                    $instance->where(function ($w) use ($request) {
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
                $groups = Group::pluck('name', 'id');
                $warehouses = Warehouse::pluck('name', 'id');
                $types = Type::pluck('name', 'id');
                $units = Unit::pluck('name', 'id');

                return view('include.product.form', compact('product', 'groups', 'types', 'units', 'warehouses'));
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
        DB::transaction(function () use ($request) {
            $purchase_price = str_replace(".", "", $request->purchase_price);
            $selling_price = str_replace(".", "", $request->selling_price);
            $product = Product::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'size' => $request->size,
                'purchase_price' => $purchase_price,
                'selling_price' => $selling_price,
                'photo' => $request->photo,
                'type_id' => $request->type_id,
                'group_id' => $request->group_id,
                'unit_id' => $request->unit_id
            ]);

            $product->warehouse()->attach($request->warehouse_id);

            return $product;
        });
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
        $updated_at = $product->updated_at->isoFormat('LLLL');
        $purchase_price = rupiah($product->purchase_price);
        $selling_price = rupiah($product->selling_price);
        $groups = Group::pluck('name', 'id');
        $types = Type::pluck('name', 'id');
        $units = Unit::pluck('name', 'id');
        return view('include.product.show', compact('product', 'units', 'types', 'groups', 'updated_at', 'created_at', 'purchase_price', 'selling_price'));
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
            $purchase_price = rupiah($product->purchase_price);
            $selling_price = rupiah($product->selling_price);
            $warehouses = Warehouse::pluck('name', 'id');
            $groups = Group::pluck('name', 'id');
            $types = Type::pluck('name', 'id');
            $units = Unit::pluck('name', 'id');
            return view('include.product.form', compact('product', 'purchase_price', 'selling_price', 'groups', 'types', 'units', 'warehouses'));
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
        DB::transaction(function () use ($product, $request) {
            $purchase_price = str_replace(".", "", $request->purchase_price);
            $selling_price = str_replace(".", "", $request->selling_price);
            $model = $product->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'size' => $request->size,
                'purchase_price' => $purchase_price,
                'selling_price' => $selling_price,
                'photo' => $request->photo,
                'type_id' => $request->type_id,
                'group_id' => $request->group_id,
                'warehouse_id' => $request->warehouse_id,
                'unit_id' => $request->unit_id
            ]);

            $product->warehouse()->sync($request->warehouse_id);


            return $model;
        });
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

    public function searchType(Request $request)
    {
        $search = $request->search;
        return Type::where('name', 'LIKE', "%$search%")->select('id', 'name')->get();
    }

    public function searchUnit(Request $request)
    {
        $search = $request->search;
        return Unit::where('name', 'LIKE', "%$search%")->select('id', 'name')->get();
    }

    public function searchGroup(Request $request, $type_id)
    {
        $search = $request->search;
        return Group::where('name', 'LIKE', "%$search%")->where('type_id', $type_id)->select('id', 'name')->get();
    }

    public function searchProduct(Request $request, $warehouse_id)
    {
        $search = $request->search;
        $products = Stock::join('products', 'products.id', '=','stocks.product_id')
                    ->where('warehouse_id', $request->warehouse_id)
                    ->where('name', 'LIKE', "%$search%")
                    ->select('product_id', 'products.name', 'products.purchase_price')
                    ->get()
                    ->map(function($p){
                        $p->purchase_price = rupiah($p->purchase_price);
                        return $p;
                    });
        
        return $products;
    }
}
