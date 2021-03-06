(function($) {
    'use strict';
    //product data table
    $(document).ready(function(){      
        var dTable = $('#supplier_table').DataTable({
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
                url: "supplier/get-list",
	            data: function (d) {
	                d.search = $('input[type="search"]').val()
	            }
            },
            columns: [
                {data:'name', name: 'name'},
                {data:'phone', name: 'phone'},
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

        var form = $('#form-supplier'),
            url = form.attr('action'),
            method = $('input[name=_method').val() == undefined ? 'POST' : 'PUT',
            message = $('input[name=_method').val() == undefined ? 'Data supplier berhasil ditambahkan' : 'Data supplier berhasil diubah';

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
                $('#supplier_table').DataTable().ajax.reload();
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
            $('.select2').select2();
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
                    $('#supplier_table').DataTable().ajax.reload();
                    showSuccessToast('Data supplier berhasil dihapus');
                },
                error: function(xhr){
                    showErrorToast();
                }
            });
        }
    });
}