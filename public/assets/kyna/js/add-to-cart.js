var timeStopCart;

function flyToElement(flyer, flyingTo) {
    var $func = $(this);
    var divider = 2;
    var flyerClone = $(flyer).clone();
    $(flyerClone).css({
        position: 'absolute',
        top: $(flyer).offset().top + "px",
        left: $(flyer).offset().left + "px",
        opacity: 1,
        'z-index': 99999,
        'border-radius': 50 + "%",
        'width': 50 + "px",
        'height': 50 + "px"
    });
    $('body').append($(flyerClone));
    var gotoX = $(flyingTo).offset().left + ($(flyingTo).width() / 6) - ($(flyer).width() / divider) / 6;
    var gotoY = $(flyingTo).offset().top + ($(flyingTo).height() / 7) - ($(flyer).height() / divider) / 7;

    $(flyerClone).animate({
            opacity: 0.9,
            left: gotoX,
            top: gotoY,
            width: "25px",
            height: "25px",
        }, 400,
        function() {
            $(flyingTo).fadeOut('fast', function() {
                $(flyingTo).fadeIn('fast', function() {
                    $(flyerClone).fadeOut('fast', function() {
                        $(flyerClone).remove();
                    });
                });
            });
        });
}

function ClickDropDownCart() {
    if ($('.cart.dropdown').hasClass('open')) {
        $('.cart.dropdown').removeClass('open');
        if ($('#shadown-cart-click').length > 0) {
            $('#shadown-cart-click').replaceWith('');
        }
    } else {
        $('.cart.dropdown').addClass('open');
        if ($('#shadown-cart-click').length > 0)
            $('#shadown-cart-click').replaceWith('')
        $('footer').after('<div id="shadown-cart-click" style="position: fixed;top: 0;left: 0;width: 100%;height: 100%;z-index: 11;background: black;opacity: 0.5;"></div>');
    }
}

(function($) {
    $.fn.privateScroll = function() {
        if (this.length === 0) {
            return this;
        }
        this.bind('DOMMouseScroll mousewheel', function(e) {
            var delta = 0;
            if (typeof e.originalEvent.wheelDeltaY !== 'undefined') { // chrome, safari, opera
                delta = e.originalEvent.wheelDeltaY;
            } else if (typeof e.originalEvent.wheelDelta !== 'undefined') { // ie
                delta = e.originalEvent.wheelDelta;
            } else if (typeof e.originalEvent.detail != 'undefined') { // ff
                delta = e.originalEvent.detail * -10;
            }
            if (delta !== 0) {
                $(this).scrollTop($(this).scrollTop() - delta);
                e.preventDefault();
                return false;
            }
        });
        return this;
    };
})(jQuery);;
(function($, window, document, undefined) {
    $(document).ready(function() {
        $("#k-header-form-cart ul.list").privateScroll();

        $('body').on('click', '.add-to-cart', function(e) {
            e.preventDefault();
            var thisBtn = $(this);

            if (!$(this).hasClass('reg')) {
                e.preventDefault();
                var pid = $(this).data('pid');
                var url = $(this).attr('href');
                var csrfToken = $('meta[name="csrf-token"]').attr("content");

                $.ajax({
                    url: url,
                    type: 'get',
                    data: {
                        pid: pid,
                        _csrf: csrfToken
                    },
                    success: function(response) {
                        if (response.result) {
                            countCart = countCart + 1;
                            sendData = true;

                            // update total count
                            $('.k-header-info .cart .count-number').html(response.totalCount);
                            $('.k-details-cart-right .count-number').html(response.totalCount);
                            $('#detail-icon-cart .detail-number').html(response.totalCount);
                            if ($('.add-to-cart.k-popup').length > 0) {
                                $('.k-popup-lesson .k-popup-lesson-close').click();
                            }

                            var isDetailPage = $('.add-to-cart').parents('body').hasClass('k-detail');
                            if (isDetailPage) {$('html, body').animate({scrollTop: 0}, 200);}
                            // update shot cart html at header
                            // $('#k-header-form-cart').parent().replaceWith(response.content);

                            var parent = thisBtn.parent();
                            parent.find('#detail-form-register').remove();

                            $("#detail-form-register .close").click(function() {
                                $(this).parent().remove();
                            });

                            if (!thisBtn.hasClass('reg')) {
                                if (thisBtn.hasClass('campaign11') && response.isRequiredGift) {
                                    var giftModal = $('#get1_buy1');
                                    giftModal.modal({
                                        backdrop: 'static',
                                        keyboard: false
                                    });
                                    giftModal.find('.modal-content').load('/cart/default/gift');
                                } else {
                                    ClickDropDownCart();
                                    timeStopCart = setTimeout(ClickDropDownCart, 5000);
                                }
                            }

                            parent.append(response.alertContent);

                            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                                let cartUrl = $(`meta[name='cart_url']`).attr('content');
                                window.location.href= cartUrl;
                            }

                        }
                    }
                });
            }
        });

        $('body').on('click', '.btn-buy-now', function(e) {
            e.preventDefault();

            if (!$(this).hasClass('reg')) {
                var pid = $(this).data('pid');
                var csrfToken = $('meta[name="csrf-token"]').attr("content");
                console.log(pid);
                let url = $(this).data('url');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        pid: pid,
                        _csrf: csrfToken
                    },
                    success: function(response) {
                        window.location = response.redirectUrl;
                    }
                });
            }
        });
        $('body').on('click', '.cart-item-change', function () {
            var pid = $(this).data('id');
            var giftModal = $('#get1_buy1');
            giftModal.modal({
                backdrop: 'static',
                keyboard: false
            });
            giftModal.find('.modal-content').load('/cart/default/change-gift?pid=' + pid);
        });
        $('body').on('click', '.cart-item-remove', function () {
            var pid = $(this).data('id');
            var url = $(this).data('url');
            $.ajax({
                type: "get",
                url: url,
                data: {
                    id:pid
                },
                dataType: "json",
                success: function (response) {
                    location.reload();
                }
            });
        });
        $('#get1_buy1').on('hidden.bs.modal', function () {
            $('#get1_buy1').find('.modal-content').empty();
            $(this).data('bs.modal', null);
            $('#get1_buy1').find('.modal-content').html('<div class=\"loading\" style=\"height: 190px; background-image: url($cdnUrl/img/loading.gif); background-repeat: no-repeat; background-position: center\"></div>');
        });
    });
})(window.jQuery, window, document);
$(document).mouseup(function(e) {
    var container = $(".k-header-wrap .cart");
    if (!container.is(e.target) &&
        container.has(e.target).length === 0) {
        $(container).click();
        if ($('#shadown-cart').length > 0) {
            $('#shadown-cart').replaceWith('');
        }
        if ($('#shadown-cart-click').length > 0) {
            $('#shadown-cart-click').replaceWith('');
        }
        if (typeof timeStopCart !== "undefined") {
            clearTimeout(timeStopCart);
        }
    }
});
$(document).ready(function () {
    $('.cart .dropdown-menu').click(function(){
        if ($('#shadown-cart-click').length > 0) {
            $('#shadown-cart-click').replaceWith('');
            $('footer').after('<div id="shadown-cart" style="position: fixed;top: 0;left: 0;width: 100%;height: 100%;z-index: 11;background: black;opacity: 0.5;"></div>');
        }
    })
})