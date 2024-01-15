window.jQuery = window.$ = require('jquery')
require('bootstrap')
require('trumbowyg')

$(function () {

    $('.toast').toast('show');

    $('.editor').trumbowyg({
        svgPath: '../../node_modules/trumbowyg/dist/ui/icons.svg'
    });

    $('.delete').click(function(e) {
       e.preventDefault();
       
       if(confirm('Are you sure you want to delete this item?!')) {
            $(this).parent().submit();
       } 
    });

    $('#images').change(function(e) {
        let files = e.target.files;

        let html = '';

        for(let file of files) {
            html += `<div class="col-4">
                        <img class="img-fluid" src="${URL.createObjectURL(file)}" />   
                    </div>`;
        }

        $('#img-container').html(html);
    });

});