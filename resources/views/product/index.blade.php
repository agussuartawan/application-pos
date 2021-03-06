@extends('layouts.main') 
@section('title', 'Produk')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/jquery-toast-plugin/dist/jquery.toast.min.css')}}">
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
    @endpush
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-package bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Produk')}}</h5>
                            <span>{{ __('List Produk')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Produk')}}</li>
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
                                    <h3>{{ __('Produk')}}</h3>
                                </div>
                                <div class="col-md-8">
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-6">
                                            {!! Form::select('type', $type, null,[ 'class'=>'form-control custom-filter', 'placeholder' => 'Filter tipe','id'=> 'type']) !!}
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::select('group', $group, null,[ 'class'=>'form-control custom-filter', 'placeholder' => 'Filter grup','id'=> 'group']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 p-0 float-right">
                                    @can('tambah produk')
                                        <a href="{{ route('products.create') }}" class="btn btn-primary float-right modal-show" title="Tambah Produk">Tambah</a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="product_table" class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th width="15%">{{ __('Kode')}}</th>
                                    <th width="35%">{{ __('Nama Barang')}}</th>
                                    <th width="15%">{{ __('Ukuran (ml)')}}</th>
                                    <th width="20%">{{ __('Harga Jual')}}</th>
                                    <th width="20%">{{ __('Aksi')}}</th>
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
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
	<script src="{{ asset('plugins/mask-money/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>
    <!--server side users table script-->
    <script src="{{ asset('js/masters/product.js') }}"></script>
    @endpush
@endsection
