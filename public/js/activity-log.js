(function($) {
    'use strict';
    //product data table
    $(document).ready(function(){

        var searchable = [];
        var selectable = []; 
        

        var dTable = $('#activity_log_table').DataTable({
            order: [],
            lengthMenu: [[10, 50, 100], [10, 50, 100]],
            serverSide: true,
            processing: true,
            responsive: true,
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
                url: 'activity-log/get-list',
                type: "get"
            },
            columns: [
                {data:'description', name: 'description'},
                {data:'created_at', name: 'created_at'},
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

    $('body').on('click', '.btn-show', function(event){
        var me = $(this);

        event.preventDefault();
        $('#modal').modal('show');
        showActivityDetail(me);
    });

    $('#modal').on('hidden.bs.modal', function(){
        $('.load-here').empty();
    });
})(jQuery);

showActivityDetail = function(me){
    var url = me.attr('href'),
        title = 'Detail Aktivitas';

    $('.modal-title').text(title);
    $('.modal-save').hide();

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'html',
        beforeSend: function(){
            $('.loader').fadeIn();
        },
        complete: function(){
            $('.loader').fadeOut();
        },
        success: function(response){
            $('.load-here').html(response);
        },
        error: function(xhr){
            showErrorToast();
        }
    });
}

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
}