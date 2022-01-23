@extends('layouts.main') 
@section('title', 'Grup Produk')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/jquery-toast-plugin/dist/jquery.toast.min.css')}}">
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-briefcase bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Grup Produk')}}</h5>
                            <span>{{ __('Mengelola data grup produk')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Grup Produk')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row clearfix">
			<div class="col-md-12">
	            <div class="card">
	                <div class="card-header form-title"></div>
	                <div class="card-body" id="product-group-form-body">
                        @include('include.loader')
                    </div>
	            </div>
	        </div>
		</div>
		<div class="row">
	        <div class="col-md-12">
	            <div class="card p-3">
	                <div class="card-header"><h3>{{ __('Grup Produk')}}</h3></div>
	                <div class="card-body">
	                    <table id="product_group_table" class="table table-bordered">
	                        <thead class="text-center">
	                            <tr>
	                                <th>{{ __('Nama Grup')}}</th>
	                                <th width="10%">{{ __('Aksi')}}</th>
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
        <script src="{{ asset('plugins/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>
        <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <!--server side roles table script-->
        <script src="{{ asset('js/masters/product-group.js') }}"></script>
	@endpush
@endsection
