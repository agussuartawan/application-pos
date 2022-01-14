<form class="forms-sample" method="POST" action="{{ route('product.create') }}">
    @csrf
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="code">{{ __('Kode')}}<span class="text-red">*</span></label>
                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" required>
                <div class="help-block with-errors"></div>

                @error('code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">{{ __('Nama Produk')}}<span class="text-red">*</span></label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Masukan nama produk" required>
                <div class="help-block with-errors" ></div>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug">{{ __('Slug')}}</label>
                <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') }}" required>
                <div class="help-block with-errors" ></div>

                @error('slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="size">{{ __('Ukuran Produk')}}<span class="text-red">*</span></label>
                <input id="size" type="number" class="form-control @error('size') is-invalid @enderror" name="size" value="{{ old('size') }}" placeholder="Masukan ukuran produk" required>
                <div class="help-block with-errors" ></div>

                @error('size')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="purchase_price">{{ __('Harga Beli')}}</label>
                        <input id="purchase_price" type="text" class="form-control @error('purchase_price') is-invalid @enderror" name="purchase_price" value="{{ old('purchase_price') }}" placeholder="Masukan harga beli" required>
                        <div class="help-block with-errors" ></div>

                        @error('purchase_price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> 
                </div>   

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="selling_price">{{ __('Harga Jual')}}</label>
                        <input id="selling_price" type="text" class="form-control @error('selling_price') is-invalid @enderror" name="selling_price" value="{{ old('selling_price') }}" placeholder="Masukan harga jual" required>
                        <div class="help-block with-errors" ></div>

                        @error('selling_price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="min_stock">{{ __('Stok Minimum')}}</label>
                        <input id="min_stock" type="text" class="form-control @error('min_stock') is-invalid @enderror" name="min_stock" value="{{ old('min_stock') }}" placeholder="Masukan jumlah stok minimum" required>
                        <div class="help-block with-errors" ></div>

                        @error('min_stock')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="max_stock">{{ __('Stok Maksimum')}}</label>
                        <input id="max_stock" type="text" class="form-control @error('max_stock') is-invalid @enderror" name="max_stock" value="{{ old('max_stock') }}" placeholder="Masukan jumlah stok maksimum" required>
                        <div class="help-block with-errors" ></div>

                        @error('max_stock')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="type">{{ __('Pilih Tipe Produk')}}<span class="text-red">*</span></label>
                {!! Form::select('type', $types, null,[ 'class'=>'form-control select2', 'placeholder' => 'Pilih tipe','id'=> 'type_id', 'required'=> 'required']) !!}
            </div>

            <div class="form-group">
                <label for="group">{{ __('Pilih Grup Produk')}}<span class="text-red">*</span></label>
                {!! Form::select('group', $groups, null,[ 'class'=>'form-control select2', 'placeholder' => 'Pilih grup','id'=> 'group_id', 'required'=> 'required']) !!}
            </div>

            <div class="form-group">
                <label for="unit">{{ __('Pilih Unit Produk')}}<span class="text-red">*</span></label>
                {!! Form::select('unit', $units, null,[ 'class'=>'form-control select2', 'placeholder' => 'Pilih unit','id'=> 'unit_id', 'required'=> 'required']) !!}
            </div>

            <div class="form-group">
                <label for="warehouse">{{ __('Pilih Gudang')}}<span class="text-red">*</span></label>
                {!! Form::select('warehouse', $warehouses, null,[ 'class'=>'form-control select2', 'placeholder' => 'Pilih gudang','id'=> 'warehouse_id', 'required'=> 'required']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group d-flex justify-content-center">
                <a href="{{ route('product.index') }}" class="btn btn-danger">Batal</a>&nbsp;
                <button type="submit" class="btn btn-primary">{{ __('Simpan')}}</button>
            </div>
        </div>
    </div>
</form>
<script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
<script>
    $('select').select2();
</script>