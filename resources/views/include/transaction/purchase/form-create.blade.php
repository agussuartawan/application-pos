<tr>
    <td>
        {!! Form::select('', [], null, ['class' => 'form-control product-select', 'id' => 'product_id_'.$row, 'data-last-select' => 'true']) !!}
        <input id='hidden_{{ $row }}' type='hidden' name='product_id[]'>
    </td>
    <td>
        {!! Form::number('qty[]', null, ['class' => 'form-control qty', 'id' => 'qty_'.$row]) !!}
    </td>
    <td>
        {!! Form::text('price[]', null, ['class' => 'form-control money single-price', 'id' => 'price_'.$row]) !!}
    </td>
    <td>
        {!! Form::number('discount[]', null, ['class' => 'form-control discount', 'id' => 'discount_'.$row]) !!}
    </td>
    <td>
        {!! Form::text('', null, ['class' => 'form-control money sub-total', 'id' => 'subtotal_'.$row, 'readonly' => 'readonly']) !!}
    </td>
    <td>
        @if($row != 1)
            <a href="" class="btn-removes" id="btn-remove-'.{{ $row }}.'"><i class="ik ik-trash-2 f-16 mr-15 text-danger"></i></a>
        @endif
    </td>
</tr>