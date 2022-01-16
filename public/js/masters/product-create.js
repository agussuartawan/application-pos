(function($) {
    'use strict';
    //product data table
    $(document).ready(function(){
        showCreateForm();
    });
})(jQuery);

showCreateForm = function(){
    $.ajax({
        url: '/product/show-form',
        type: 'GET',
        dataType: 'html',
        beforeSend: function() {
            $('.loader').show();
        },
        complete: function(){
            $('.loader').hide();
        },
        success: function(response){
            $('.card-body').html(response);
        },
        error: function(xhr, status){
            alert('Terjadi kesalahan')
        }
    });
}