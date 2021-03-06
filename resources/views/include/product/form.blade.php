{!! Form::model($product, [
    'route' => $product->exists ? ['products.update', $product->id] : 'products.store',
    'method' => $product->exists ? 'PUT' : 'POST',
    'id' => 'form-product'
]) !!}

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="code">{{ __('Kode')}}<span class="text-red">*</span></label>
                {!! Form::text('code', null,[ 'class'=>'form-control', 'placeholder' => '[Auto]','id'=> 'code', 'disabled' => 'disabled']) !!}
            </div>

            <div class="form-group">
                <label for="name">{{ __('Nama Produk')}}<span class="text-red">*</span></label>
                {!! Form::text('name', null,[ 'class'=>'form-control', 'placeholder' => 'Nama produk','id'=> 'name']) !!}
            </div>

            <div class="form-group">
                <label for="slug">{{ __('Slug')}}</label>
                {!! Form::text('slug', null,[ 'class'=>'form-control', 'id'=> 'slug']) !!}
            </div>

            <div class="form-group">
                <label for="size">{{ __('Ukuran Produk')}}<span class="text-red">*</span></label>
                {!! Form::number('size', null,[ 'class'=>'form-control', 'placeholder' => 'Ukuran produk', 'id'=> 'size']) !!}
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="purchase_price">{{ __('Harga Beli')}}</label>
                        {!! Form::text('purchase_price', $purchase_price ?? null,[ 'class'=>'form-control money', 'placeholder' => 'Harga beli produk', 'id'=> 'purchase_price']) !!}
                    </div> 
                </div>   

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="selling_price">{{ __('Harga Jual')}}</label>
                        {!! Form::text('selling_price', $selling_price ?? null,[ 'class'=>'form-control money', 'placeholder' => 'Harga jual produk', 'id'=> 'selling_price']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="type_id">{{ __('Pilih Tipe Produk')}}<span class="text-red">*</span></label>
                {!! Form::select('type_id', $types, null,[ 'class'=>'form-control select2', 'placeholder' => 'Pilih tipe','id'=> 'type_id']) !!}
            </div>

            <div class="form-group">
                <label for="group_id">{{ __('Pilih Grup Produk')}}<span class="text-red">*</span></label>
                {!! Form::select('group_id', $groups, null,[ 'class'=>'form-control select2', 'placeholder' => 'Pilih grup','id'=> 'group_id']) !!}
            </div>

            <div class="form-group">
                <label for="unit_id">{{ __('Pilih Unit Produk')}}<span class="text-red">*</span></label>
                {!! Form::select('unit_id', $units, null,[ 'class'=>'form-control select2', 'placeholder' => 'Pilih unit','id'=> 'unit_id']) !!}
            </div>

            <div class="form-group">
                <label for="warehouse_id">{{ __('Pilih Gudang')}}<span class="text-red">*</span></label>
                {!! Form::select('warehouse_id[]', $warehouses, $product->warehouse()->pluck('warehouse_id'),[ 'class'=>'form-control select2', 'multiple' => 'multiple','id'=> 'warehouse_id']) !!}
            </div>
        </div>
    </div>

{!! Form::close() !!}

<script>
    $('.money').maskMoney({
        thousands:'.', 
        decimal:',',
        affixesStay: false, 
        precision: 0
    });
</script>