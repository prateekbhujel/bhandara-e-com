window.jQuery = window.$ = require('jquery')
require('bootstrap')

$(function() {
    
    loadTotal();

    $('.toast').toast('show');

    $('.nav-item.dropdown').mouseenter(function() {
        $(this).addClass('show');
        $(this).children('.dropdown-menu').addClass('show');
        $(this).children('.dropdown-toggle').attr('aria-expanded', 'true');
    }).mouseleave(function() {
        $(this).removeClass('show');
        $(this).children('.dropdown-menu').removeClass('show');
        $(this).children('.dropdown-toggle').attr('aria-expanded', 'false');
    });

    $('.img-small').on('mouseenter click', function() {
        var src = $(this).data('src');
        $('.img-large').css("background-image", "url('"+src+"')");
    });

    var imgLarge = $('.img-large');

    imgLarge.mousemove(function(event) {
        var relX = event.pageX - $(this).offset().left;
        var relY = event.pageY - $(this).offset().top;
        var width = $(this).width();
        var height = $(this).height();
        var x = (relX / width) * 100;
        var y = (relY / height) * 100;
        $(this).css("background-position", x+"% "+y+"%");
    });

    imgLarge.mouseout(function() {
        $(this).css("background-position", "center");
    });

    $( window ).resize(function() {
        setImgLarge();
        setImgSmall();
    });

    //Add to cart Method
    $('.add-to-cart').click(function() {
        let id = $(this).data(id);
        let csrf_token = $("meta[name='csrf_token']").attr('content');
        let qty = 1;
        
        if($('#qty').length) {
            qty = $('#qty').val();

            $('#qty').val(1);
        }
        
        $.ajax({
            url: route('front.cart.store', [id, qty]),
            data: {
                _token: csrf_token
            },
            method: 'POST'
        }).done(function(resp) {
            msg= `<div class="toast align-items-center text-bg-success border-0 mt-3" role="alert" aria-live="assertive" araia-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    ${resp.success}
                                </div>
                                <button type="button" class="btn-close-white me-2 auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                      </div>`;
            
            $("#toast-container").html(msg);
            
            $(".toast").toast('show');

            loadTotal();

        });
    });
    
    function loadTotal()
    {
        $.get(route('front.cart.total'))
        .done(function(resp) {
           $("#header-qty").html(resp.qty)
           $("#header-price").html(`Rs. ${resp.price}`) 
        })
    }

    setImgLarge();
    setImgSmall();

});

function setImgLarge() {
    var imgLarge = $('.img-large');
    var width = imgLarge.width();
    imgLarge.height(width * 2/3);
}

function setImgSmall() {
    var imgSmall = $('.img-small');
    var width = imgSmall.width();
    imgSmall.height(width);
}