@extends('layouts.main') 
@section('title', 'Produk')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    @endpush
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-folder bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Persediaan')}}</h5>
                            <span>{{ __('List Persediaan')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Persediaan')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-2 p-0 float-left">
                                    <h3>{{ __('Persediaan')}}</h3>
                                </div>
                                <div class="col-md-8">
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-12">
                                            {!! Form::select('warehouse_id', $warehouses, null,[ 'class'=>'form-control custom-filter','id'=> 'warehouse_id']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 p-0 float-right">
                                    {{-- @can('tambah produk') --}}
                                        <a href="" class="btn btn-primary float-right" title="Transfer Gudang">{{ __('Transfer Gudang') }}</a>
                                    {{-- @endcan --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="stock_table" class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th width="15%">{{ __('Kode')}}</th>
                                    <th width="35%">{{ __('Nama Barang')}}</th>
                                    <th width="20%">{{ __('Sisa Stok')}}</th>
                                    <th width="20%">{{ __('Lokasi')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <!--server side users table script-->
    <script src="{{ asset('js/page/stock.js') }}"></script>
    @endpush
@endsection
