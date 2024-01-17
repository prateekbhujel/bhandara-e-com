window.jQuery = window.$ = require('jquery')
require('bootstrap')
require('trumbowyg')

$(function () {

    $('.toast').toast('show');

    $('.editor').trumbowyg({
        svgPath: route('front.pages.index') + '../../node_modules/trumbowyg/dist/ui/icons.svg'
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

    $(".img-delete").click(function(e) {
        
        e.preventDefault();

        if(confirm("Are you Sure you want to delete this image?")) 
        {
            let id = $(this).data('id');
            let file = $(this).data('file');
            let csrf_token = $("meta[name='csrf_token']").attr('content')

            $.ajax({
                url: route('admin.products.image', [id, file]),
                method: 'delete',
                data: {
                    _token: csrf_token
                }
                
            }).done().fail();
        }
    });

});