(function($) {
    'use strict';
    //product data table
    $(document).ready(function(){      
        var dTable = $('#purchase_table').DataTable({
            lengthMenu: [[5, 10, 50, 100], [5, 10, 50, 100]],
            serverSide: true,
            processing: true,
            responsive: true,
            autoWidth: false,
            order: [[ 0, "desc" ]],
            language: {
                processing: '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;"></i>',
                lengthMenu: 'Tampilkan _MENU_ data',
                zeroRecords: 'Data tidak ditemukan',
                info: 'Menampilkan _START_ ke _END_ dari _TOTAL_ data',
                infoEmpty: 'Menampilkan 0 ke 0 dari 0 data',
                emptyTable: 'Tidak ada data tersedia pada tabel',
                infoFiltered: '(Difilter dari _MAX_ total data)',
                search: 'Cari:',
                paginate: {
                    first: '<i class="ik ik-chevrons-left"></i>',
                    last: '<i class="ik ik-chevrons-right"></i>',
                    next: '<i class="ik ik-chevron-right"></i>',
                    previous: '<i class="ik ik-chevron-left"></i>'
                }
            },
            scroller: {
                loadingIndicator: false
            },
            pagingType: "full_numbers",
            dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
            ajax: {
                url: "purchase/get-list",
	            data: function (d) {
	                d.status = $('#status').val(),
                    d.warehouse_id = $('#warehouse_id').val(),
                    d.from = $('#from').val(),
	                d.to = $('#to').val(),
	                d.search = $('input[type="search"]').val()
	            }
            },
            columns: [
                {data:'purchase_number', name: 'purchase_number'},
                {data:'supplier_name', name: 'supplier.name'},
                {data:'date', name: 'date'},
                {data:'total', name: 'total'},
                {data:'warehouse', name: 'warehouse'},
                {data:'action', name: 'action', orderable: false}
            ],
            buttons: [
                {
                    extend: 'copy',
                    className: 'btn-sm btn-info',
                    title: 'Produk',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    className: 'btn-sm btn-success',
                    title: 'Produk',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn-sm btn-warning',
                    title: 'Produk',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible',
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn-sm btn-primary',
                    title: 'Produk',
                    pageSize: 'A4',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    className: 'btn-sm btn-default',
                    title: 'Produk',
                    // orientation:'landscape',
                    pageSize: 'A4',
                    header: true,
                    footer: false,
                    orientation: 'landscape',
                    exportOptions: {
                        // columns: ':visible',
                        stripHtml: false
                    }
                }
            ],
            initComplete: function(settings, json) {
	            $('input[type="search"').unbind();
	            $('input[type="search"').bind('keyup', function(e) {
	                if(e.keyCode == 13) {
	                    dTable.search( this.value ).draw();
	                }
	            }); 
	        }
        });

	    $('.custom-filter').change(function(){
	        dTable.draw();
	    });
    });

    $('body').on('click', '.btn-show', function(){
        event.preventDefault();
    	var me = $(this);
    	$('.modal-save').addClass('hide');
        $('#modal').modal('show');
    	showModal(me);
    });

    $('#modal').on('hidden.bs.modal', function(){
        $('.load-here').empty();
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