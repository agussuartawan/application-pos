@extends('layouts.main') 
@section('title', 'Supplier')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jquery-toast-plugin/dist/jquery.toast.min.css')}}">
    @endpush
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-shopping-cart bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Supplier')}}</h5>
                            <span>{{ __('List Supplier')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Supplier')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header">
                        <h3>{{ __('Supplier')}}</h3>
                        <div class="row ml-auto">
                            @can('tambah supplier')
                                <a href="{{ route('suppliers.create') }}" class="btn btn-primary float-right modal-show" title="Tambah Supplier">{{ __('Tambah Supplier') }}</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="supplier_table" class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th width="50%">{{ __('Nama Supplier')}}</th>
                                    <th width="30%">{{ __('Telpon')}}</th>
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
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>
    <!--server side users table script-->
    <script src="{{ asset('js/masters/supplier.js') }}"></script>
    @endpush
@endsection
