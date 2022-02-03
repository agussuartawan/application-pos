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
                {!! Form::date('date', null, ['class' => 'form-control date', 'id' => 'date', 'data-role' => 'datepicker']) !!}
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
                <label for="terms">{{ __('Batas Kredit') }}<span class="text-red">*</span></label>
                {!! Form::select('terms', [], null, ['class' => 'form-control', 'id' => 'terms']) !!}
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="due_date">Tanggal Jatuh Tempo</label>      
                {!! Form::date('due_date', null, ['class' => 'form-control date', 'id' => 'due_date', 'data-role' => 'datepicker']) !!}
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="warehouse_id">{{ __('Gudang') }}<span class="text-red">*</span></label>
                {!! Form::select('', [], null, ['class' => 'form-control', 'id' => 'warehouse_id']) !!}
                <input type="hidden" name="warehouse_id" id="hidden_warehouse_id">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 py-4">
            <div id="alert-purchase-product"></div>
            <div class="table-responsive">
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
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
{!! Form::close() !!}

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