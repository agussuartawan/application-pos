{!! Form::model($product_type, [
    'route' => $product_type->exists ? ['product-types.update', $product_type->id] : 'product-types.store',
    'method' => $product_type->exists ? 'PUT' : 'POST',
    'id' => 'form-product-type'
]) !!}

    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <label for="name">{{ __('Tipe Produk')}}<span class="text-red">*</span></label>
                {!! Form::text('name', null,[ 'class'=>'form-control', 'placeholder' => 'Nama tipe','id'=> 'name']) !!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-rounded">{{ __('Simpan')}}</button>
            </div>
        </div>
    </div>

{!! Form::close() !!}