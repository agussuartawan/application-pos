(function($) {
    'use strict';
    //product data table
    $(document).ready(function(){

        var searchable = [];
        var selectable = []; 
        

        var dTable = $('#product_type_table').DataTable({
            order: [],
            lengthMenu: [[5, 10, 50, 100], [5, 10, 50, 100]],
            responsive: true,
            serverSide: true,
            processing: true,
            autoWidth: false,
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
                    first: 'Awal',
                    last: 'Akhir',
                    next: 'Selanjutnya',
                    previous: 'Sebelumnya'
                }
            },
            scroller: {
                loadingIndicator: false
            },
            pagingType: "full_numbers",
            dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
            ajax: {
                url: 'product-type/get-list',
                type: "get"
            },
            columns: [
                /*{data:'serial_no', name: 'serial_no'},*/
                {data:'name', name: 'name'},
                //only those have manage_user permission will get access
                {data:'action', name: 'action', orderable: false, searchable: false}
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
            initComplete: function () {
                var api =  this.api();
                api.columns(searchable).every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    input.setAttribute('placeholder', $(column.header()).text());
                    input.setAttribute('style', 'width: 140px; height:25px; border:1px solid whitesmoke;');

                    $(input).appendTo($(column.header()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });

                    $('input', this.column(column).header()).on('click', function(e) {
                        e.stopPropagation();
                    });
                });

                api.columns(selectable).every( function (i, x) {
                    var column = this;

                    var select = $('<select style="width: 140px; height:25px; border:1px solid whitesmoke; font-size: 12px; font-weight:bold;"><option value="">'+$(column.header()).text()+'</option></select>')
                        .appendTo($(column.header()).empty())
                        .on('change', function(e){
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column.search(val ? '^'+val+'$' : '', true, false ).draw();
                            e.stopPropagation();
                        });

                    $.each(dropdownList[i], function(j, v) {
                        select.append('<option value="'+v+'">'+v+'</option>')
                    });
                });
            }
        });
    }); 

    $(document).ready(function(){
        showCreateForm();
    });
    
    $('body').on('click', '.btn-edit', function(event){
        event.preventDefault();

        var url = $(this).attr('href');

        $.ajax({
            url: url,
            dataType: 'html',
            beforeSend: function() {
                $('.preloader').fadeIn();
            },
            complete: function(){
                $('.preloader').fadeOut();
            },
            success: function(response){
                $('.form-title').html('<h3>Edit Tipe Produk</h3>');
                $('#product-type-form-body').html(response);
                $('#name').focus();
                $("html, body").animate({ scrollTop: 0 }, "slow");
            },
            error: function(xhr, status){
                showErrorToast();
            }
        });
    });

    $('body').on('click', '.btn-delete', function(event){
        event.preventDefault();
        var me = $(this);
        showDeleteAlert(me);
    });

    $(document).on('submit','#form-product-type', function(event) {
        event.preventDefault();

        var form = $(this),
            url = form.attr('action'),
            method = $('input[name=_method').val() == undefined ? 'POST' : 'PUT',
            message = $('input[name=_method').val() == undefined ? 'Data tipe berhasil ditambahkan' : 'Data tipe berhasil diubah';

        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        
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
                showCreateForm();
                $('#product_type_table').DataTable().ajax.reload();
            },
            error: function(xhr){
                showErrorToast();
                var res = xhr.responseJSON;
                if($.isEmptyObject(res) == false){
                    $.each(res.errors, function(key, value){
                        $('#' + key)
                            .addClass('is-invalid')
                            .after('<span class="invalid-feedback" role="alert"><strong>' +value+ '</strong></span>');
                    });
                }
            }
        });
    });

})(jQuery);

showCreateForm = function() {
    $.ajax({
        url: '/product-type/show-form',
        type: 'GET',
        dataType: 'html',
        beforeSend: function() {
            $('.loader').fadeIn();
        },
        complete: function(){
            $('.loader').fadeOut();
        },
        success: function(response){
            $('.form-title').html('<h3>Tambah Tipe Produk</h3>');
            $('#product-type-form-body').html(response);
        },
        error: function(xhr, status){
            alert('Terjadi kesalahan')
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
                    $('#product_type_table').DataTable().ajax.reload();
                    showSuccessToast('Data tipe berhasil dihapus');
                },
                error: function(xhr){
                    showErrorToast();
                }
            });
        }
    });
}