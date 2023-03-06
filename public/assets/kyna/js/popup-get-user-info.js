(function ($, window, document, undefined) {
    var showPopup = true;

    // trigger event when user mouse out from kyna
    $(document).mouseleave(function(e) {
        var hasCart = countCart > 0;

        if (hasCart && showPopup) {
            showPopup = false;
            $('#btn-add-user-info').trigger('click');
        }
    });

    $('body').on('hidden.bs.modal', '#popup-user-info', function () {
        $.ajax({
            url: "/cart/default/disable-popup",
        });
    });
})(window.jQuery, window, document);