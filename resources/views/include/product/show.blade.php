{!! Form::model($product, [
    'id' => 'show-product'
]) !!}

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="code">{{ __('Kode')}}</label>
                {!! Form::text('code', null,['class'=>'form-control', 'placeholder' => 'Kode produk','id'=> 'code', 'disabled' => 'disabled']) !!}
            </div>

            <div class="form-group">
                <label for="name">{{ __('Nama Produk')}}</label>
                {!! Form::text('name', null,[ 'class'=>'form-control', 'placeholder' => 'Nama produk','id'=> 'name', 'disabled' => 'disabled']) !!}
            </div>

            <div class="form-group">
                <label for="slug">{{ __('Slug')}}</label>
                {!! Form::text('slug', null,[ 'class'=>'form-control', 'id'=> 'slug','disabled' => 'disabled']) !!}
            </div>

            <div class="form-group">
                <label for="size">{{ __('Ukuran Produk')}}</label>
                {!! Form::number('size', null,[ 'class'=>'form-control', 'placeholder' => 'Ukuran produk', 'id'=> 'size', 'disabled' => 'disabled']) !!}
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="purchase_price">{{ __('Harga Beli')}}</label>
                        {!! Form::text('purchase_price', $purchase_price,[ 'class'=>'form-control', 'placeholder' => 'Harga beli produk', 'id'=> 'purchase_price', 'disabled' => 'disabled']) !!}
                    </div> 
                </div>   

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="selling_price">{{ __('Harga Jual')}}</label>
                        {!! Form::text('selling_price', $selling_price,[ 'class'=>'form-control', 'placeholder' => 'Harga jual produk', 'id'=> 'selling_price', 'disabled' => 'disabled']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="min_stock">{{ __('Stok Minimum')}}</label>
                        {!! Form::number('min_stock', null,[ 'class'=>'form-control', 'placeholder' => 'Stok minimum produk', 'id'=> 'min_stock', 'disabled' => 'disabled']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="max_stock">{{ __('Stok Maksimum')}}</label>
                        {!! Form::number('max_stock', null,[ 'class'=>'form-control', 'placeholder' => 'Stok maksimum produk', 'id'=> 'max_stock', 'disabled' => 'disabled']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="type">{{ __('Pilih Tipe Produk')}}</label>
                {!! Form::select('type_id', $types, null,[ 'class'=>'form-control select2', 'placeholder' => 'Pilih tipe','id'=> 'type_id', 'disabled' => 'disabled']) !!}
            </div>

            <div class="form-group">
                <label for="group">{{ __('Pilih Grup Produk')}}</label>
                {!! Form::select('group_id', $groups, null,[ 'class'=>'form-control select2', 'placeholder' => 'Pilih grup','id'=> 'group_id', 'disabled' => 'disabled']) !!}
            </div>

            <div class="form-group">
                <label for="unit">{{ __('Pilih Unit Produk')}}</label>
                {!! Form::select('unit_id', $units, null,[ 'class'=>'form-control select2', 'placeholder' => 'Pilih unit','id'=> 'unit_id', 'disabled' => 'disabled']) !!}
            </div>

            <div class="form-group">
                <label for="warehouse">{{ __('Pilih Gudang')}}</label>
                {!! Form::select('warehouse_id', $warehouses, null,[ 'class'=>'form-control select2', 'placeholder' => 'Pilih gudang','id'=> 'warehouse_id', 'disabled' => 'disabled']) !!}
            </div>

            <div class="form-group">
                <label for="stock">{{ __('Sisa Stok')}}</label>
                {!! Form::number('stock', null,[ 'class'=>'form-control', 'id'=> 'stock', 'disabled' => 'disabled']) !!}
            </div>

            <div class="form-group">
                <label for="created">{{ __('Ditambahkan Pada')}}</label>
                {!! Form::text('created', $created_at,[ 'class'=>'form-control', 'id'=> 'created', 'disabled' => 'disabled']) !!}
            </div>
        </div>
    </div>

{!! Form::close() !!}