$(document)
    .ready(function() {

        // fix menu when passed
        $('.masthead')
            .visibility({
                once: false,
                onBottomPassed: function () {
                    $('.fixed.menu').transition('fade in');
                },
                onBottomPassedReverse: function () {
                    $('.fixed.menu').transition('fade out');
                }
            })
        ;

        // create sidebar and attach to menu open
        $('.ui.sidebar')
            .sidebar('attach events', '.toc.item')
        ;

        hljs.initHighlightingOnLoad();

        // Handling the modal confirmation message.
        $(document).on('submit', 'form[data-confirmation]', function (event) {
            var $form = $(this),
                $confirm = $('#confirmationModal');

            if ($confirm.data('result') !== 'yes') {
                //cancel submit event
                event.preventDefault();

                $confirm
                    .off('click', '#btnYes')
                    .on('click', '#btnYes', function () {
                        $confirm.data('result', 'yes');
                        $form.find('input[type="submit"]').attr('disabled', 'disabled');
                        $form.submit();
                    })
                    .modal('show');
            }
        })
    })
;