var row = 1;
(function($) {
    'use strict';

    $(document).ready(function(){  
        showCreate();
    });

    $('body').on('change', '#warehouse_id', function(event){
        var warehouse_id = $(this).val();
        select_2_product(warehouse_id);
    });

    $('body').on('change', '.qty', function(){
        const me = $(this);
        const id = me.attr('id');
        const row_number = id.slice(-1);
        const discount = $(`#discount_${row_number}`).val();
        const qty = me.val();
        const price = $(`#price_${row_number}`).val();
        countSubtotal(qty, price,discount, row_number);
        countGrandTotal();
    });

    $('body').on('change', '.single-price', function(){
        const me = $(this);
        const id = me.attr('id');
        const row_number = id.slice(-1);
        const discount = $(`#discount_${row_number}`).val();
        const price = me.val();
        const qty = $(`#qty_${row_number}`).val();
        countSubtotal(qty, price, discount, row_number);
        countGrandTotal();
    });

    $('body').on('change', '.discount', function(){
        const me = $(this);
        const id = $(this).attr('id');
        const row_number = id.slice(-1);
        const price = $(`#price_${row_number}`).val();
        const discount = me.val();
        const qty = $(`#qty_${row_number}`).val();
        countSubtotal(qty, price, discount, row_number);
        countGrandTotal();
    });

    $('body').on('change', '.product-select', function(){
        const me = $(this);
        if(me.attr('data-last-select') == 'true'){
            showCreateForm(row++);
            me.removeAttr('data-last-select');
        }
    });

    $('body').on('click', '.btn-removes', function(event){
        event.preventDefault();
        var first_td = $(this).closest('tr').children('td:first');
        if(first_td.find('.product-select').attr('data-last-select') == 'true'){
            $(this).closest('tr').prev('tr').children('td:first').find('.product-select').attr('data-last-select', 'true');
        }
        $(this).parents('tr').remove();
        countGrandTotal();
    });

    $('body').on('click', '#btn-save', function(event) {
        event.preventDefault();

        var form = $('#create-purchase-form'),
            url = form.attr('action'),
            method = 'POST',
            message = 'Data pembelian berhasil disimpan';

        $('.text-red').remove();
        $('#alert-purchase').empty();
        $('#alert-purchase-product').empty();
        
        $.ajax({
            url: url,
            method: method,
            data: form.serialize(),
            beforeSend: function() {
                $('.preloader').fadeIn();
            },
            complete: function(){
                $('.preloader').fadeOut();
            },
            success: function(response){
                window.row = 1;
                showSuccessToast(message);
                showCreate();
            },
            error: function(xhr){
                showErrorToast();
                var res = xhr.responseJSON;
                if($.isEmptyObject(res) == false){
                    var is_product_invalid = false;
                    $.each(res.errors, function(key, value){
                        if(key != 'supplier_id'){
                            $('#' + key).closest('.form-group')
                            .addClass('input-group-danger')
                            .append(`<small class="text-red">${value}</small>`);
                        } else {
                            $('#alert-purchase').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                ${value}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="ik ik-x"></i>
                                </button>
                            </div>`);
                        }

                        if (key == 'product_id' || key == 'qty' || key == 'price' || key == 'discount') {
                            is_product_invalid = true;
                        }
                    });

                    if (is_product_invalid) {
                        $('#alert-purchase-product').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Mohon isi data produk dengan benar!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="ik ik-x"></i>
                            </button>
                        </div>`);
                    }
                }
            }
        });
    });
})(jQuery);

showSuccessToast = (message) => {
    'use strict';
    $.toast({
        heading: 'Sukses',
        text: message,
        showHideTransition: 'slide',
        icon: 'success',
        loaderBg: '#f96868',
        position: 'top-right'
    });
};

showErrorToast = () => {
    'use strict';
    $.toast({
        heading: 'Error',
        text: 'Terjadi kesalahan',
        showHideTransition: 'slide',
        icon: 'error',
        loaderBg: '#f2a654',
        position: 'top-right'
    });
};

searchWarehouse = () => {
    $('#warehouse_id').select2({
        ajax: {
            url: '/product/warehouse',
            dataType: 'json',
            data: function (params) {
                var query = {
                    search: params.term
                };

                return query;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        };
                    })
                };
            },
        },
        placeholder: 'Cari Gudang',
    })
    .on('select2:select', function(){
        var this_value = $(this).val();
        $('#hidden_warehouse_id').val(this_value);
    });
}

searchSupplier = () => {
    $('#supplier_id').select2({
        ajax: {
            url: '/supplier-search',
            dataType: 'json',
            data: function (params) {
                var query = {
                    search: params.term
                };

                return query;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id,
                            email: item.email,
                            address: item.address
                        };
                    })
                };
            },
        },
        placeholder: 'Cari Supplier',
        cache: true,
    })
    .on('select2:select', function (event) {
        var data = event.params.data;
        $('#supplier_email').val(data.email);
        $('#supplier_address').val(data.address);
    });
}

searchTerm = () => {
    $('#terms').select2({
        ajax: {
            url: '/term-search',
            dataType: 'json',
            data: function (params) {
                var query = {
                    search: params.term
                };

                return query;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.description,
                            id: item.id,
                            term_day: item.term_day
                        };
                    })
                };
            },
        },
        placeholder: 'Pilih batas kredit',
        cache: true,
    })
    .on('select2:select', function(event){
        var data = event.params.data,
            date = $('#date').val(),
            days = data.term_day;
        if(days){
            var due_date = addDays(date, days);
            $('#due_date').val(due_date);
        } else {
            var today = new Date().toISOString().slice(0, 10);
            $('#due_date').val(today);   
        }
    });
}

showCreateForm = (row) => {
    var warehouse_id = $('#warehouse_id').val();
    $.ajax({
        url: '/purchase/showFormCreate',
        type: 'GET',
        data: {
            row: row
        },
        dataType: 'html',
        success: function (response) {
            $('#purchase-create-table tbody').append(response);
            select_2_product(warehouse_id);
            maskMoney();
            countGrandTotal();
        },
        error: function (xhr, status) {
            alert('Terjadi kesalahan');
        }
    });
}

showCreate = () => {
    $.ajax({
        url: '/purchase/showCreate',
        type: 'GET',
        dataType: 'html',
        beforeSend: function() {
            $('.loader').fadeIn();
        },
        complete: function(){
            $('.loader').fadeOut();
        },
        success: function (response) {
            $('.card-body').html(response);
            showCreateForm(row++);
            searchSupplier();
            searchWarehouse();
            searchTerm();

            //get current date
            var today = new Date().toISOString().slice(0, 10);
            $('.date').val(today);
        },
        error: function (xhr, status) {
            alert('Terjadi kesalahan');
        }
    });
}

select_2_product = (warehouse_id) => {
    $('.product-select').select2({
        ajax: {
            url: '/product-search/' + warehouse_id,
            dataType: 'json',
            data: function (params) {
                var query = {
                    search: params.term
                };

                return query;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.product_id,
                            purchase_price: item.purchase_price
                        };
                    })
                };
            },
        },
        placeholder: 'Cari Produk',
        cache: true,
        allowClear: true,
    })
    .on('select2:select', function (event) {
        var data = event.params.data;
        var id = $(this).attr('id');
        var id_number = id.slice(-1);

        $(`#price_${id_number}`).val(data.purchase_price);
        var price = $(`#price_${id_number}`).val();

        if (!$(`#qty_${id_number}`).val()) {
            $(`#qty_${id_number}`).val(1);
        }
        var qty = $(`#qty_${id_number}`).val();

        if (!$(`#discount_${id_number}`).val()) {
            $(`#discount_${id_number}`).val(0);
        }
        var discount = $(`#discount_${id_number}`).val();

        countSubtotal(qty, price, discount, id_number);
        countGrandTotal();

        var this_value = $(this).val();
        var id = $(this).attr('id');
        var row_id = id.slice(-1);
        $(`#hidden_${row_id}`).val(this_value);
        $('#warehouse_id').prop('disabled',true);
    })
    .on('select2:clear', function (event) {
        var id = $(this).attr('id');
        var id_number = id.slice(-1);

        $(`#price_${id_number}`).val(0);
        var price = $(`#price_${id_number}`).val();

        var qty = $(`#qty_${id_number}`).val();

        var discount = $(`#discount_${id_number}`).val();

        countSubtotal(qty, price, discount, id_number);
        countGrandTotal();

        $(`#hidden_${id_number}`).val('');
    });
}

maskMoney = () => {
    $('.money').maskMoney({
        thousands: '.',
        decimal: ',',
        affixesStay: false,
        precision: 0
    });
}

countSubtotal = (qty, price, discount, row_id) => {
    var qty = parseInt(qty), discount = parseInt(discount) / 100, subtotal = 0, discount_rp;

    if (price) {
        var price = price.replaceAll('.', '');
        discount_rp = price * discount;
        subtotal = (price - discount_rp) * qty;
    }

    $(`#subtotal_${row_id}`).val(Math.round(subtotal));
}

countGrandTotal = () => {
    var last_subtotal_id = $('.sub-total').last().attr('id'), subtotal_row = last_subtotal_id.slice(-1), subtotal = 0, discount_total = 0;

    for (let index = 1; index <= subtotal_row; index++) {
        var this_value = $(`#subtotal_${index}`).val();
        if (this_value && this_value != undefined) {
            var this_subtotal = this_value.replaceAll('.', '');
            subtotal = parseInt(subtotal) + parseInt(this_subtotal);
        }

        //Hitung diskon
        var this_price = $(`#price_${index}`).val(), this_discount = $(`#discount_${index}`).val(), this_qty = $(`#qty_${index}`).val();

        if (this_price && this_price != undefined) {
            if (this_discount && this_discount != undefined) {
                this_discount = this_discount / 100;
                this_price = this_price.replaceAll('.', '');
                var this_discount_total = (this_price * this_qty) * this_discount;
                discount_total = discount_total + this_discount_total;
            }
        }
    }
    $('#ppn').text(rupiah(countPPN(subtotal)));
    $('#grand_total').text(rupiah(subtotal));
    $('#discount_total').text(rupiah(Math.round(discount_total)));
}

countPPN = (value) => Math.round(value * 0.1)

var originalVal = $.fn.val;
$.fn.val = function(value) {
    if (typeof value == 'undefined') {
        return originalVal.call(this);
    } else {
        setTimeout(function() {
            this.trigger('mask.maskMoney');
        }.bind(this), 100);
        return originalVal.call(this, value);
    }
};

rupiah = (bilangan) => {
    var number_string = bilangan.toString(), sisa = number_string.length % 3, rupiah = number_string.substr(0, sisa), ribuan = number_string.substr(sisa).match(/\d{3}/g);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    // Cetak hasil
    return rupiah;
}

addDays = (date, days) => {
    var result = new Date(date);
    result.setDate(result.getDate() + days);

    var day = result.getDate().toString().padStart(2, "0"),
        month = (result.getMonth() + 1).toString().padStart(2, "0"),
        year = result.getFullYear();

    return year +'-'+ month +'-'+ day;
}