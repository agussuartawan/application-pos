<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use DataTables, Auth;

class SupplierController extends Controller
{
    public function index()
    {
        return view('supplier.index');
    }

    public function getSupplierList(Request $request)
    {

        $data  = Supplier::query();

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                $buttons = '';
                if (Auth::user()->can('lihat supplier')) {
                    $buttons .= '<a class="modal-show btn-show" href="' . url('suppliers/' . $data->id) . '/show" title="Detail ' . $data->name . '" data-name="' . $data->name . '"><i class="ik ik-eye f-16 mr-15 text-info"></i></a>';
                }
                if (Auth::user()->can('edit supplier')) {
                    $buttons .= '<a class="modal-show" href="' . url('suppliers/' . $data->id) . '/edit" title="Edit ' . $data->name . '"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>';
                }
                if (Auth::user()->can('hapus supplier')) {
                    $buttons .= '<a class="btn-delete" href="' . url('suppliers/' . $data->id) . '" title="Hapus ' . $data->name . '" data-name="' . $data->name . '"><i class="ik ik-trash-2 f-16 mr-15 text-red"></i></a>';
                }

                return '<div class="table-actions text-center">' . $buttons . '</div>';
            })
            ->filter(function ($instance) use ($request) {
                if (!empty($request->search)) {
                    $instance->where(function ($w) use ($request) {
                        $search = $request->search;
                        $w->orWhere('name', 'LIKE', "%$search%")
                            ->orWhere('phone', 'LIKE', "%$search%");
                    });
                }

                return $instance;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        try {
            if (Auth::user()->can('tambah supplier')) {
                $supplier = new Supplier();

                return view('include.supplier.form', compact('supplier'));
            } else {
                return '<div class="text-center">Anda tidak memiliki akses untuk menambah supplier</div>';
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return $bug;
        }
    }

    public function store(StoreSupplierRequest $request)
    {
        $supplier = Supplier::create($request->all());
        return $supplier;
    }

    public function show(Supplier $supplier)
    {
        $created_at = $supplier->created_at->isoFormat('LLLL');
        $updated_at = $supplier->updated_at->isoFormat('LLLL');
        return view('include.supplier.show', compact('supplier', 'updated_at', 'created_at'));
    }

    public function edit(Supplier $supplier)
    {
        if (Auth::user()->can('edit supplier')) {
            return view('include.supplier.form', compact('supplier'));
        } else {
            return '<div class="text-center">Anda tidak memiliki akses untuk mengedit supplier</div>';
        }
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $model = $supplier->update($request->all());
        return $model;
    }

    public function destroy(Supplier $supplier)
    {
        try {
            $supplier->delete();
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return $bug;
        }
    }
}
