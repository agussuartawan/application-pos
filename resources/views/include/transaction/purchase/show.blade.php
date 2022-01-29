<div class="row">
    <div class="col-sm-6">
        <div class="row">
            <div class="col text-left">
                <h6>{{ __('No Pembelian') }}</h6>
                <h6>{{ __('Supplier') }}</h6>
                <h6>{{ __('Tanggal') }}</h6>
                <h6>{{ __('Tanggal Jatuh Tempo') }}</h6>
                <h6>{{ __('Batas Kredit') }}</h6>
                <h6>{{ __('No Inv Pembelian') }}</h6>
                <h6>{{ __('Ditambahkan ke') }}</h6>
            </div>

            <div class="d-flex flex-column text-left">
                <h6>{{ $purchase->purchase_number }}</h6>
                <h6>{{ $purchase->supplier->name }}</h6>
                <h6>{{ Carbon\Carbon::parse($purchase->date)->isoFormat('DD MMMM Y') }}</h6>
                <h6>{{ Carbon\Carbon::parse($purchase->due_date)->isoFormat('DD MMMM Y') }}</h6>
                <h6>{{ $purchase->terms }}</h6>
                <h6>{{ $purchase->purchase_invoice_number ?? '-' }}</h6>
                <h6>{{ $purchase->warehouse->name }}</h6>
            </div>
        </div>
    </div>

    <div class="col-sm-6 text-right">
        <h3 class="">RP. {{ rupiah($purchase->total) }}</h3>
        <span class="badge {{ $status_class }}">{{ $purchase->status }}</span>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive mt-2">
            <table class="table table-bordered" id="purchase-detail-table" style="min-width: 40rem">
                <thead>
                    <tr>
                        <th width="25%">Produk</th>
                        <th width="15%">Qty</th>
                        <th width="15%">Harga</th>
                        <th width="15%">Diskon</th>
                        <th width="20%">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchase->product as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->pivot->qty }}</td>
                            <td>{{ rupiah($product->pivot->price) }}</td>
                            <td>
                                {{ rupiah(
                                    discountRp($product->pivot->discount,$product->pivot->price,$product->pivot->qty)
                                ) }}
                            </td>
                            <td>{{ rupiah($product->pivot->subtotal) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>