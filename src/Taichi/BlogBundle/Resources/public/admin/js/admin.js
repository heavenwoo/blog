(function (a) {
    //a(document).ready(function () {
    //    a('[data-toggle="datetimepicker"]').datetimepicker({
    //        icons: {
    //            time: 'fa fa-clock-o',
    //            date: 'fa fa-calendar',
    //            up: 'fa fa-chevron-up',
    //            down: 'fa fa-chevron-down',
    //            previous: 'fa fa-chevron-left',
    //            next: 'fa fa-chevron-right',
    //            today: 'fa fa-check-circle-o',
    //            clear: 'fa fa-trash',
    //            close: 'fa fa-remove'
    //        }
    //    })
    //});
    a(document).on('submit', 'form[data-confirmation]', function (n) {
        var e = a(this), t = a('#confirmationModal');
        if (t.data('result') !== 'yes') {
            n.preventDefault();
            t.off('click', '#btnYes').on('click', '#btnYes', function () {
                t.data('result', 'yes');
                e.find('input[type="submit"]').attr('disabled', 'disabled');
                e.submit()
            }).modal('show')
        }
    })
})(window.jQuery);

$(document)
    .ready(function() {
        hljs.initHighlightingOnLoad();
    });