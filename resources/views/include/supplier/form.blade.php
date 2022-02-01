{!! Form::model($supplier, [
    'route' => $supplier->exists ? ['suppliers.update', $supplier->id] : 'suppliers.store',
    'method' => $supplier->exists ? 'PUT' : 'POST',
    'id' => 'form-supplier'
]) !!}

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="name">{{ __('Nama Supplier')}}<span class="text-red">*</span></label>
                {!! Form::text('name', null,[ 'class'=>'form-control', 'placeholder' => 'Nama supplier','id'=> 'name']) !!}
            </div>
            
            <div class="form-group">
                <label for="phone">{{ __('Telpon')}}</label>
                {!! Form::text('phone', null,[ 'class'=>'form-control', 'placeholder' => 'Telpon supplier', 'id'=> 'phone']) !!}
            </div> 

            <div class="form-group">
                <label for="email">{{ __('E-mail')}}</label>
                {!! Form::text('email', null,[ 'class'=>'form-control', 'placeholder' => 'E-mail supplier', 'id'=> 'email']) !!}
            </div> 

            <div class="form-group">
                <label for="address">{{ __('Alamat')}}</label>
                {!! Form::textarea('address', null,[ 'class'=>'form-control', 'rows' => 1, 'id'=> 'address']) !!}
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="identification_type">{{  __('Kartu Identitas') }}</label>
                {!! Form::select('identification_type', [
                    'KTP' => 'KTP',
                    'NPWP' => 'NPWP',
                    'Passport' => 'Passport'
                    ], null, ['class' => 'form-control select2', 'id' => 'identification_type']) !!}
            </div>

            <div class="form-group">
                <label for="identification_number">{{  __('Nomor Identitas') }}</label>
                {!! Form::text('identification_number', null,[ 'class'=>'form-control', 'id'=> 'identification_number']) !!}
            </div>
        </div>
    </div>

{!! Form::close() !!}