(function($) {
    'use strict';

    var row = 1;


    $(document).ready(function(){  
        showCreateForm(row++);
        searchSupplier();
        searchWarehouse();

	    $('.custom-filter').change(function(){
	        dTable.draw();
	    });
    });

    $('body').on('change', '.qty', function(){
        const me = $(this);
        const id = $(this).attr('id');
        const row_number = id.slice(-1);
        const discount = $(`#discount_${row_number}`).val();
        const qty = me.val();
        const price = $(`#price_${row_number}`).val();
        countSubtotal(qty, price,discount, row_number);
        countGrandTotal();
    });

    $('body').on('change', '.single-price', function(){
        const me = $(this);
        const id = $(this).attr('id');
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
    });

    $('.modal-save').on('click', function(event) {
        event.preventDefault();

        var form = $('#form-product'),
            url = form.attr('action'),
            method = $('input[name=_method').val() == undefined ? 'POST' : 'PUT',
            message = $('input[name=_method').val() == undefined ? 'Data produk berhasil ditambahkan' : 'Data produk berhasil diubah';

        $('.form-group').removeClass('input-group-danger');
        $('.text-danger').remove();
        
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
                showSuccessToast(message);
                $('#modal').modal('hide');
                $('#product_table').DataTable().ajax.reload();
            },
            error: function(xhr){
                showErrorToast();
                var res = xhr.responseJSON;
                if($.isEmptyObject(res) == false){
                    $.each(res.errors, function(key, value){
                        $('#' + key)
                            .closest('.form-group')
                            .addClass('input-group-danger')
                            .append(`<small class="text-danger">${value}</small>`);
                    });
                }
            }
        });
    });

    $('#modal').on('hidden.bs.modal', function(){
        $('.load-here').empty();
    });

    $('body').on('change', '#type_id', function(event){
        var type_id = $(this).val();
        searchGroup(type_id);
    });
})(jQuery);

showSuccessToast = function(message) {
    'use strict';
    $.toast({
        heading: 'Sukses',
        text: message,
        showHideTransition: 'slide',
        icon: 'success',
        loaderBg: '#f96868',
        position: 'top-right'
    })
};

showErrorToast = function() {
    'use strict';
    $.toast({
        heading: 'Error',
        text: 'Terjadi kesalahan',
        showHideTransition: 'slide',
        icon: 'error',
        loaderBg: '#f2a654',
        position: 'top-right'
    })
};

searchWarehouse = function(){
	$('#warehouse_id').select2({
    	ajax: {
    		url: '/product/warehouse',
    		dataType: 'json',
    		data: function(params){
    			var query = {
    				search: params.search
    			}

    			return query;
    		},
		    processResults: function (data){
		      return {
		        results:  $.map(data, function (item) {
		              return {
		                  text: item.name,
		                  id: item.id
		              }
		          })
		      };
		    },
    	},
    	placeholder: 'Cari Gudang',
    	cache: true,
        allowClear: true,
    });
}

searchSupplier = function(){
    $('#supplier_id').select2({
        ajax: {
            url: '/supplier-search',
            dataType: 'json',
            data: function(params){
                var query = {
                    search: params.search
                }

                return query;
            },
            processResults: function (data){
              return {
                results:  $.map(data, function (item) {
                      return {
                          text: item.name,
                          id: item.id,
                          email: item.email,
                          address: item.address
                      }
                  })
              };
            },
        },
        placeholder: 'Cari Supplier',
        cache: true,
        allowClear: true,
    })
    .on('select2:select', function(event) {
        var data = event.params.data;
        $('#supplier_email').val(data.email);
        $('#supplier_address').val(data.address);
    });
}

showCreateForm = function(row){
    $.ajax({
        url: '/purchase/showFormCreate',
        type: 'GET',
        data: {
            row: row
        },  
        dataType: 'html',
        success: function(response){
            $('#purchase-create-table tbody').append(response);
            select_2_product();
            maskMoney();
            countGrandTotal();
        },
        error: function(xhr, status){
            alert('Terjadi kesalahan');
        }
    })
}

select_2_product = function(){
    $('.product-select').select2({
        ajax: {
            url: '/product-search',
            dataType: 'json',
            data: function(params){
                var query = {
                    search: params.search
                }

                return query;
            },
            processResults: function (data){
              return {
                results:  $.map(data, function (item) {
                      return {
                          text: item.name,
                          id: item.id,
                          purchase_price: item.purchase_price
                      }
                  })
              };
            },
        },
        placeholder: 'Cari Produk',
        cache: true,
        allowClear: true,
    })
    .on('select2:select', function(event) {
        var data = event.params.data;
        var id = $(this).attr('id');
        var id_number = id.slice(-1);
        var price = $(`#price_${id_number}`).val(data.purchase_price);
        var qty = $(`#qty_${id_number}`).val();
        var discount = $(`#discount_${id_number}`).val();
        countSubtotal(qty, price, discount, id_number);
        countGrandTotal();
    })
    .on('select2:clear', function(event) {
        var id = $(this).attr('id');
        var id_number = id.slice(-1);
        var price = $(`#price_${id_number}`).val(0);
        var qty = $(`#qty_${id_number}`).val();
        var discount = $(`#discount_${id_number}`).val();
        countSubtotal(qty, price, discount, id_number);
        countGrandTotal();
    });
}

maskMoney = function(){
    $('.money').maskMoney({
        thousands:'.', 
        decimal:',',
        affixesStay: false, 
        precision: 0
    });
}

countSubtotal = function(qty, price, discount, row_id){
    var qty = parseInt(qty),
        discount = parseInt(discount) / 100,
        subtotal = 0,
        discount_rp;

    if(price){
        var price = price.replaceAll('.', '');
        discount_rp = price * discount;
        subtotal = (price - discount_rp) * qty;
    }

    $(`#subtotal_${row_id}`).val(subtotal);
}

countGrandTotal = function(){
    var subtotal_row = $('.sub-total').length,
        subtotal = 0;
    for (let index = 0; index < subtotal_row; index++) {
        var this_value = $(`#subtotal_${index}`).val();
        if(this_value != undefined){
            var this_subtotal = this_value.replaceAll('.', '');
            subtotal = parseInt(subtotal) + parseInt(this_subtotal);
        }
    }
    $('#grand_total').text(subtotal);
}

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