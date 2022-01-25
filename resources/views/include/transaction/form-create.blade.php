<tr>
    <td>
        {!! Form::select('product_id[]', $products, null, ['class' => 'form-control product-select', 'id' => 'product_id_'.$row, 'data-last-select' => 'true']) !!}
    </td>
    <td>
        {!! Form::number('qty', null, ['class' => 'form-control', 'id' => 'qty_'.$row]) !!}
    </td>
    <td>
        {!! Form::text('price', null, ['class' => 'form-control', 'id' => 'price_'.$row]) !!}
    </td>
    <td>
        {!! Form::text('subtotal', null, ['class' => 'form-control', 'id' => 'subtotal_'.$row]) !!}
    </td>
    <td>
        @if($row != 1)
            <a href="javascript:void()" class="btn-removes" id="btn-remove-'.{{ $row }}.'"><i class="ik ik-trash-2 f-16 mr-15 text-danger"></i></a>
        @endif
    </td>
</tr>

<script>
    $('.product-select').select2({
        width: '100%'
    });
</script>