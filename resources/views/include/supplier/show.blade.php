{!! Form::model($supplier, [
    'id' => 'show-supplier'
]) !!}

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="name">{{ __('Nama Supplier')}}<span class="text-red">*</span></label>
                {!! Form::text('name', null,[ 'class'=>'form-control', 'id'=> 'name', 'readonly' => true]) !!}
            </div>
            
            <div class="form-group">
                <label for="phone">{{ __('Telpon')}}</label>
                {!! Form::text('phone', null,[ 'class'=>'form-control', 'id'=> 'phone', 'readonly' => true]) !!}
            </div> 

            <div class="form-group">
                <label for="email">{{ __('E-mail')}}</label>
                {!! Form::text('email', null,[ 'class'=>'form-control', 'id'=> 'email', 'readonly' => true]) !!}
            </div> 

            <div class="form-group">
                <label for="address">{{ __('Alamat')}}</label>
                {!! Form::textarea('address', null,[ 'class'=>'form-control', 'rows' => 1, 'id'=> 'address', 'readonly' => true]) !!}
            </div>
        </div>
    </div>

{!! Form::close() !!}