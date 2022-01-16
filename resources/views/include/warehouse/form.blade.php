{!! Form::model($warehouse, [
    'route' => $warehouse->exists ? ['warehouses.update', $warehouse->id] : 'warehouses.store',
    'method' => $warehouse->exists ? 'PUT' : 'POST',
    'id' => 'form-warehouse'
]) !!}

    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <label for="name">{{ __('Gudang')}}<span class="text-red">*</span></label>
                {!! Form::text('name', null,[ 'class'=>'form-control', 'placeholder' => 'Nama gudang','id'=> 'name']) !!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-rounded">{{ __('Simpan')}}</button>
            </div>
        </div>
    </div>

{!! Form::close() !!}