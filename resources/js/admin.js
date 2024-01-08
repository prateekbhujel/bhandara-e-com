window.jQuery = window.$ = require('jquery')
require('bootstrap')

$(function () {

    $('.toast').toast('show');

    $('.delete').click(function(e) {
       e.preventDefault();
       
       if(confirm('Are you sure you want to delete this item?!')) {
            $(this).parent().submit();
       } 
    });

});