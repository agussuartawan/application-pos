@extends('layouts.main') 
@section('title', 'Tambah produk')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Tambah Produk')}}</h5>
                            <span>{{ __('Tambah data produk baru')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('product.index') }}">{{ __('Produk')}}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Tambah Produk')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Tambah Produk')}}</h3>
                    </div>
                    <div class="card-body">
                        @include('include.loader')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script') 
        <script>
            $(document).ready(function(){
                $.ajax({
                    url: '/product/show-form',
                    type: 'GET',
                    dataType: 'html',
                    beforeSend: function() {
                        $('.loader').show();
                    },
                    complete: function(){
                        $('.loader').hide();
                    },
                    success: function(response){
                        $('.card-body').html(response);
                    },
                    error: function(xhr, status){
                        alert('Terjadi kesalahan')
                    }
                });
            });
        </script>
    @endpush
@endsection
