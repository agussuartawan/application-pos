{!! Form::model($product_unit, [
    'route' => $product_unit->exists ? ['product-units.update', $product_unit->id] : 'product-units.store',
    'method' => $product_unit->exists ? 'PUT' : 'POST',
    'id' => 'form-product-unit'
]) !!}

    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <label for="name">{{ __('Unit Produk')}}<span class="text-red">*</span></label>
                {!! Form::text('name', null,[ 'class'=>'form-control', 'placeholder' => 'Nama unit','id'=> 'name']) !!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-rounded">{{ __('Simpan')}}</button>
            </div>
        </div>
    </div>

{!! Form::close() !!}