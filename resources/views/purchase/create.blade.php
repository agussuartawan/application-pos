@extends('layouts.main') 
@section('title', 'Pembelian Baru')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
        <style>
            .select2-selection { overflow: hidden; }
            .select2-selection__rendered { white-space: normal; word-break: break-all; }
        </style>
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Pembelian Baru')}}</h5>
                            <span>{{ __('Menambah data pembelian baru')}}</span>
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
                                <a href="{{route('purchases.index')}}">{{ __('Data Pembelian') }}</i></a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ __('Pembelian Baru')}}
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
                <div class="card ">
                    <div class="card-body">
                        <form action="#" id="create-purchase-form">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="supplier_id">{{ __('Supplier') }}<span class="text-red">*</span></label>
                                        {!! Form::select('supplier_id', $suppliers, null, ['class' => 'form-control purchase-select', 'id' => 'supplier_id']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email">{{ __('E-mail') }}</label>
                                        {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="date">Tanggal</label>      
                                        {!! Form::date('date', null, ['class' => 'form-control date', 'id' => 'date']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="purchase_invoice_number">{{ __('No Invoice Pembelian') }}</label>
                                        {!! Form::text('purchase_invoice_number', null, ['class' => 'form-control', 'placeholder' => 'Optional', 'id' => 'purchase_invoice_number']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="address">{{ __('Alamat') }}</label>
                                    {!! Form::textarea('address', null, ['class' => 'form-control', 'id' => 'address', 'rows' => 1]) !!}
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="terms_id">{{ __('Batas Kredit') }}<span class="text-red">*</span></label>
                                        {!! Form::select('terms_id', ['name' => 'COD'], null, ['class' => 'form-control purchase-select','placeholder' => 'Pilih Kredit', 'id' => 'terms_id']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="due_date">Tanggal Jatuh Tempo</label>      
                                        {!! Form::date('due_date', null, ['class' => 'form-control date', 'id' => 'due_date']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="warehouse_id">{{ __('Gudang') }}<span class="text-red">*</span></label>
                                        {!! Form::select('warehouse_id', $warehouses, null, ['class' => 'form-control purchase-select', 'id' => 'warehouse_id']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive py-4">
                                        <table class="table" id="purchase-create-table" style="min-width: 50rem">
                                            <thead>
                                                <tr>
                                                    <th width="30%">Produk<span class="text-red">*</span></th>
                                                    <th width="20%">Qty</th>
                                                    <th width="20%">Harga</th>
                                                    <th width="20%">Subtotal</th>
                                                    <th width="10%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script') 
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
         <!--get role wise permissiom ajax script-->
        <script src="{{ asset('js/get-role.js') }}"></script>
        <script src="{{ asset('js/transactions/create-purchase.js') }}"></script>
    @endpush
@endsection
