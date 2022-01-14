(function($) {
    'use strict';
    //product data table
    $(document).ready(function(){

        var searchable = [];
        var selectable = []; 
        

        var dTable = $('#warehouse_table').DataTable({
            order: [],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            processing: true,
            responsive: false,
            serverSide: true,
            processing: true,
            language: {
            processing: '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;"></i>'
            },
            scroller: {
                loadingIndicator: false
            },
            pagingType: "full_numbers",
            dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
            ajax: {
                url: 'warehouse/get-list',
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
        $.ajax({
            url: '/warehouse/show-form',
            type: 'GET',
            dataType: 'html',
            beforeSend: function() {
                $('.loader').show();
            },
            complete: function(){
                $('.loader').hide();
            },
            success: function(response){
                $('#warehouse-form-body').html(response);
            },
            error: function(xhr, status){
                alert('Terjadi kesalahan')
            }
        });
    });

    $(document).on('submit','#form-warehouse', function(event) {
        event.preventDefault();

        var form = $(this),
            url = form.attr('action'),
            method = $('input[name=_method').val() == undefined ? 'POST' : 'PUT';

        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        
        $.ajax({
            url: url,
            method: method,
            data: form.serialize(),
            success: function(response){
                showSuccessToast();
                form.trigger('reset');
                $('#warehouse_table').DataTable().ajax.reload();
            },
            error: function(xhr){
                showDangerToast();
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

showSuccessToast = function() {
    'use strict';
    resetToastPosition();
    $.toast({
        heading: 'Sukses',
        text: 'Data gudang berhasil ditambahkan',
        showHideTransition: 'slide',
        icon: 'success',
        loaderBg: '#f96868',
        position: 'top-right'
    })
};

showDangerToast = function() {
    'use strict';
    resetToastPosition();
    $.toast({
        heading: 'Error',
        text: 'Terjadi kesalahan',
        showHideTransition: 'slide',
        icon: 'error',
        loaderBg: '#f2a654',
        position: 'top-right'
    })
};