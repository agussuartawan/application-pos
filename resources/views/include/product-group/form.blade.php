{!! Form::model($product_group, [
    'route' => $product_group->exists ? ['product-groups.update', $product_group->id] : 'product-groups.store',
    'method' => $product_group->exists ? 'PUT' : 'POST',
    'id' => 'form-product-group'
]) !!}

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="name">{{ __('Grup Produk')}}<span class="text-red">*</span></label>
                {!! Form::text('name', null,[ 'class'=>'form-control', 'placeholder' => 'Nama grup','id'=> 'name']) !!}
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="name">{{ __('Tipe')}}<span class="text-red">*</span></label>
                {!! Form::select('type_id', $types, $product_group->type()->select('id')->get(),[ 'class'=>'form-control', 'placeholder' => 'Pilih tipe','id'=> 'type_id']) !!}
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-rounded">{{ __('Simpan')}}</button>
            </div>
        </div>
    </div>

{!! Form::close() !!}
<script>
    $('#type_id').select2();
</script>