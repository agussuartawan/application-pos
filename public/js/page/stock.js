(function($) {
    'use strict';
    //product data table
    $(document).ready(function(){      
        var dTable = $('#stock_table').DataTable({
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
                url: "stock/get-list",
	            data: function (d) {
	                d.warehouse_id = $('#warehouse_id').val(),
	                d.search = $('input[type="search"]').val()
	            }
            },
            columns: [
                {data:'code', name: 'product.code'},
                {data:'name', name: 'product.name'},
                {data:'in_stock', name: 'in_stock'},
                {data:'location', name: 'location', orderable: false, searchable: false},
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
})(jQuery);