jQuery(document).ready(function ($) {
    var modal = $('#write-review-modal');
    var btn = $('#write-review-button');
    var span = $('.close-modal');

    btn.on('click', function () {
        modal.show();
    });

    span.on('click', function () {
        modal.hide();
    });

    $(window).on('click', function (event) {
        if ($(event.target).is(modal)) {
            modal.hide();
        }
    });
});
