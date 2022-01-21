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
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="type">{{ __('Tipe Produk')}}</label>
                {!! Form::select('type_id', $types, null,[ 'class'=>'form-control select2', 'placeholder' => 'Pilih tipe','id'=> 'type_id', 'disabled' => 'disabled']) !!}
            </div>

            <div class="form-group">
                <label for="group">{{ __('Grup Produk')}}</label>
                {!! Form::select('group_id', $groups, null,[ 'class'=>'form-control select2', 'placeholder' => 'Pilih grup','id'=> 'group_id', 'disabled' => 'disabled']) !!}
            </div>


            <div class="form-group">
                <label for="unit">{{ __('Unit Produk')}}</label>
                {!! Form::select('unit_id', $units, null,[ 'class'=>'form-control select2','id'=> 'unit', 'disabled' => 'disabled']) !!}
            </div>

            <div class="form-group">
                <label for="created">{{ __('Ditambahkan Pada')}}</label>
                {!! Form::text('created', $created_at,[ 'class'=>'form-control', 'id'=> 'created', 'disabled' => 'disabled']) !!}
            </div>

            <div class="form-group">
                <label for="updated">{{ __('Terakhir Diubah Pada')}}</label>
                {!! Form::text('updated', $updated_at,[ 'class'=>'form-control', 'id'=> 'updated', 'disabled' => 'disabled']) !!}
            </div>

        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label>{{ __('Gudang')}}</label><br>
                @foreach($warehouses as $warehouse)
                    <div class="badge badge-secondary">{{ $warehouse->name }}</div>
                @endforeach
            </div>
        </div>
    </div>

{!! Form::close() !!}