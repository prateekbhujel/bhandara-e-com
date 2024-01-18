window.jQuery = window.$ = require('jquery')
require('bootstrap')
require('trumbowyg')

$(function () {

    $('.toast').toast('show');

    $('.editor').trumbowyg({
        svgPath: route('front.pages.index') + '/node_modules/trumbowyg/dist/ui/icons.svg'
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
            let csrf_token = $("meta[name='csrf_token']").attr('content');
            let msg = '';
            let img_col = $(this).parents('.col-4').first();

            $.ajax({
                url: route('admin.products.image', [id, file]),
                method: 'delete',
                data: {
                    _token: csrf_token
                }
            }).done(function(resp){
                img_col.remove();
                msg= `<div class="toast align-items-center text-bg-success border-0 mt-3" role="alert" aria-live="assertive" araia-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    ${resp.success}
                                </div>
                                <button type="button" class="btn-close-white me-2 auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                      </div>`;
            }).fail(function(resp){
                msg = `<div class="toast align-items-center text-bg-danger border-0 mt-3" role="alert" aria-live="assertive" araia-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    ${JSON.parse(resp.responseText).error}
                                </div>
                                <button type="button" class="btn-close-white me-2 auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>`;
            }).always(function() {

                $('#toast-container').html(msg);

                $('.toast').toast('show');
                
            });
        }
    });

});