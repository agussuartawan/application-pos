@extends('layouts.main') 
@section('title', 'Pembelian Baru')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/select-2-responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/jquery-toast-plugin/dist/jquery.toast.min.css')}}">
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Edit Pembelian')}}</h5>
                            <span>{{ __('Mengubah data pembelian')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('purchases.index')}}">{{ __('Data Pembelian') }}</i></a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ __('Edit Pembelian')}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="alert-purchase"></div>    
                <div class="card ">
                    <div class="card-body">@include('include.loader')</div>
                    
                    <div class="card-footer d-flex justify-content-center">
                        <a href="{{ route('purchases.index') }}" class="btn btn-danger mr-2">{{ __('Batal') }}</a>
                        <button type="button" class="btn btn-primary mr-2" id="btn-save">{{ __('Simpan')}}</button>
                        <button type="button" class="btn btn-warning" id="btn-save-print">{{ __('Simpan & Cetak')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script') 
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('plugins/mask-money/jquery.mask.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>
        <script src="{{ asset('js/transactions/edit-purchase.js') }}"></script>
    @endpush
@endsection
