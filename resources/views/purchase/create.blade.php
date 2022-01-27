@extends('layouts.main') 
@section('title', 'Pembelian Baru')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.css') }}">
        <link rel="stylesheet" href="{{ asset('css/select-2-responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/jquery-toast-plugin/dist/jquery.toast.min.css')}}">
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
                        {!! Form::open([
                            'route' => 'purchases.store',
                            'method' => 'POST',
                            'id' => 'create-purchase-form'
                        ]) !!}
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="supplier_id">{{ __('Supplier') }}<span class="text-red">*</span></label>
                                        {!! Form::select('supplier_id', [], null, ['class' => 'form-control', 'id' => 'supplier_id']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email">{{ __('E-mail') }}</label>
                                        {!! Form::text('supplier_email', null, ['class' => 'form-control', 'id' => 'supplier_email']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="date">Tanggal</label>      
                                        {!! Form::text('date', null, ['class' => 'form-control date', 'id' => 'date', 'data-role' => 'datepicker']) !!}
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
                                    {!! Form::textarea('supplier_address', null, ['class' => 'form-control', 'id' => 'supplier_address', 'rows' => 1]) !!}
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="terms_id">{{ __('Batas Kredit') }}<span class="text-red">*</span></label>
                                        {!! Form::select('terms', [], null, ['class' => 'form-control', 'id' => 'terms']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="due_date">Tanggal Jatuh Tempo</label>      
                                        {!! Form::text('due_date', null, ['class' => 'form-control date', 'id' => 'due_date', 'data-role' => 'datepicker']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="warehouse_id">{{ __('Gudang') }}<span class="text-red">*</span></label>
                                        {!! Form::select('warehouse_id', [], null, ['class' => 'form-control', 'id' => 'warehouse_id']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive py-4">
                                        <table class="table" id="purchase-create-table" style="min-width: 50rem">
                                            <thead>
                                                <tr>
                                                    <th width="25%">Produk<span class="text-red">*</span></th>
                                                    <th width="15%">Qty</th>
                                                    <th width="15%">Harga</th>
                                                    <th width="15%">Diskon (%)</th>
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

                            <div class="row">
                                <div class="col text-right">
                                    <h6>Diskon (Rp)</h6>
                                    <h6>PPN (Rp)</h6>
                                    <h5>Total (Rp)</h5>
                                </div>
                                <div class="d-flex flex-column text-right pr-3">
                                    <h6 id="discount_total">0</h6>
                                    <h6 id="ppn">0</h6>
                                    <h5 id="grand_total">0</h5>
                                </div>
                            </div>


                        </div>
                        
                        <div class="card-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger mr-2">{{ __('Batal')}}</button>
                            <button type="submit" class="btn btn-primary mr-2">{{ __('Simpan')}}</button>
                            <button type="button" class="btn btn-warning">{{ __('Simpan & Cetak')}}</button>
                        </div>
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script') 
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('plugins/mask-money/jquery.mask.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>
        <script src="{{ asset('js/transactions/create-purchase.js') }}"></script>
    @endpush
@endsection
