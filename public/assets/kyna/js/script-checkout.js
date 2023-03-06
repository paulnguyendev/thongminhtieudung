function handleCopyClipboard (){
    const copyClipboard = $('.copyClipboardJs');

    copyClipboard.on('click', function () {
        const tooltip = $(this).find('.tooltip-text');
        const copyContent = $(this).data('content');

        navigator.clipboard.writeText(copyContent).then(function() {
            if (tooltip.length == 0) {
                return;
            }
            tooltip.html('Đã sao chép');

            if ($(window).width() < 1199) {
                tooltip.addClass('show');

                setTimeout(function () {
                    tooltip.removeClass('show');
                }, 2000)
            }
        });
    });

    copyClipboard.on('mouseout', function () {
        $(this).find('.tooltip-text').html('Sao chép nội dung');
    })
}

$(document).ready(function() {
    /* HEIGHT BOX CHECKOUT */

    // init payment methods
    $("input[name=\'payment[method_id]\']:radio:checked").parent().find('.checkout-wrap-list').css('height', 'auto');

    /* HIDE/SHOW BOX CACH THUC THANH TOAN */
    $("input[name=\'payment[method_id]\']").click(function() {
        $('.field-paymentform-method .input-error').html('');
        var valshow = $(this).val();
        $("div.checkout-wrap-list").removeClass('open').css('height', 0);
        var current = $("#checkout-show-" + valshow).parent();

        var total = $('#checkout-form .checkout-list label').length;
        $('#checkout-form .checkout-list label').css('margin-bottom', '0');
        var current_method = $(this).parents('.checkout-list');
        var current_index = $(current_method).index();
        var height_margin = $(current_method).find('.checkout-sub-list').height() + 47;
        if (current_index % 2 == 0) {
            if (current_method < total - 1) {
                $(current_method).find('label').css('margin-bottom', height_margin);
            } else {
                $(current_method).find('label').css('margin-bottom', height_margin);
                if ($(window).width() > 767)
                    $(current_method).next().find('label').css('margin-bottom', height_margin);
            }
        } else {
            $(current_method).find('label').css('margin-bottom', height_margin);
            if ($(window).width() > 767)
                $(current_method).prev().find('label').css('margin-bottom', height_margin);
        }
        $(current).addClass('open').css('height', height_margin);

        $('.detail-method-pay > div').hide();
        var checkoutShowId = (valshow == 'epay' || valshow == 'ipay') ? 'mobile-card' : valshow;
        var checkout_show = '.detail-method-pay [data-render="checkout-show-' + checkoutShowId + '"]';
        if ($(checkout_show).length > 0)
            $(checkout_show).show();
        if (valshow === 'cod')
            $('div[visible-input="address"], div[visible-input="note"], .checkout .wrap-content-right .wrap .note-cod').show();
        else
            $('div[visible-input="address"], div[visible-input="note"], .checkout .wrap-content-right .wrap .note-cod').hide();
        $('[for-id="method"]').html($(this).parent().find('methodname').html());
    });
    $("input[name='PaymentForm[serviceCode]']").click(function() {
        $('.field-paymentform-servicecode .input-error').hide();
    });
    /* CALL FORM CHECKOUT */

    $('#checkout-form .checkout-list input:checked').click();

    $('body').on('click', '#checkout-form .checkout-button, #checkout-home .checkout-button-mb, #checkout-form .btn-submit-card-mobile', function (event) {
        event.preventDefault();
        $('.loading-checkout').addClass('open');

        var data = $('#checkout-form').serializeArray();
        var action = $('#checkout-form').attr('action');

        $.post(action, data, function (response) {
            if (response.result) {
                if (response.redirectUrl !== undefined) {
                    window.location.replace(response.redirectUrl);
                } else {
                    window.location.reload();
                }
            } else {
                // login failed
                $.each(response.errors, function (key, value){
                    $('.field-' + key)
                        .removeClass('has-success')
                        .addClass('has-error')
                        .find('.input-error')
                        .html(value);
                });
                var priority = Object.keys(response.errors)[0];
                if (priority != undefined)
                    $('html,body').animate({
                        scrollTop: $('.field-' + priority).offset().top
                    }, 300);
            }
            $('.loading-checkout').removeClass('open');
        });
    });

    handleCopyClipboard();
});
