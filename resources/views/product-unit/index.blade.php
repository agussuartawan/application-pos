@extends('layouts.main') 
@section('title', 'Unit Produk')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/jquery-toast-plugin/dist/jquery.toast.min.css')}}">
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-archive bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Unit Produk')}}</h5>
                            <span>{{ __('Mengelola data unit produk')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Unit Produk')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row clearfix">
			<div class="col-md-12">
	            <div class="card">
	                <div class="card-header form-title"></div>
	                <div class="card-body" id="product-unit-form-body">
                        @include('include.loader')
                    </div>
	            </div>
	        </div>
		</div>
		<div class="row">
	        <div class="col-md-12">
	            <div class="card p-3">
	                <div class="card-header"><h3>{{ __('Unit Produk')}}</h3></div>
	                <div class="card-body">
	                    <table id="product_unit_table" class="table table-bordered">
	                        <thead class="text-center">
	                            <tr>
	                                <th>{{ __('Nama Unit')}}</th>
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
        <!--server side roles table script-->
        <script src="{{ asset('js/masters/product-unit.js') }}"></script>
	@endpush
@endsection
