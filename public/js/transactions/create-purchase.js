(function($) {
    'use strict';

    var row = 1;

    $('select').select2({
        width: '100%'
    });

    $(document).ready(function(){  
        showCreateForm(row++);

	    $('.custom-filter').change(function(){
	        dTable.draw();
	    });
    });

    $('body').on('change', '.product-select', function(){
        const me = $(this);
        if(me.attr('data-last-select') == 'true'){
            showCreateForm(row++);
            me.removeAttr('data-last-select');
        }
    });

    $('body').on('click', '.btn-removes', function(){
        var first_td = $(this).closest('tr').children('td:first');
        if(first_td.form.attr('data-last-select') == 'true'){
            $(this).parents('tr').prev()[0].attr('data-last-select', 'true');
        }
        $(this).parents('tr').remove();
    });


    $('body').on('click', '.modal-show', function(){
        var me = $(this);
        event.preventDefault();
        $('.modal-save').removeClass('hide');
        $('#modal').modal('show');
        showModal(me);
    });

    $('body').on('click', '.btn-delete', function(){
        event.preventDefault();
        var me = $(this);
        showDeleteAlert(me);
    });

    $('body').on('click', '.btn-show', function(){
        event.preventDefault();
    	var me = $(this);
    	$('.modal-save').addClass('hide');
        $('#modal').modal('show');
    	showModal(me);
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

showModal = function(me){
    var url = me.attr('href'),
        title = me.attr('title');

    $('.modal-title').text(title);

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'html',
        beforeSend: function() {
            $('.loader').show();
        },
        complete: function(){
            $('.loader').hide();
        },
        success: function(response){
            $('.load-here').html(response);
            searchWarehouse();
            searchType();
            searchUnit();
            searchGroup(null);
        },
        error: function(xhr, status){
            alert('Terjadi kesalahan');
            $('#modal').modal('hide');
        }
    });
}

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

showDeleteAlert = function(me) {
    var url = me.attr('href'),
                title = me.attr('data-name'),
                token = $('meta[name="csrf-token"]').attr('content');

    Swal.fire({
        title: 'Perhatian!',
        text: "Hapus data "+ title +"?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    '_method': 'DELETE',
                    '_token': token, 
                },
                success: function(response){
                    $('#product_table').DataTable().ajax.reload();
                    showSuccessToast('Data produk berhasil dihapus');
                },
                error: function(xhr){
                    showErrorToast();
                }
            });
        }
    });
}

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
    	cache: true
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
        },
        error: function(xhr, status){
            alert('Terjadi kesalahan');
        }
    })
}