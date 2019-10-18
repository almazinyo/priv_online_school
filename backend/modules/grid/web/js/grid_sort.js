$(document).ready(function () {
    "use strict";
    var class_name = $('.form-grid-sort').data("class-name");


    $('.grid-submit').click(function () {

        var visible_columns = $('.sortable-visible li').map(function () {
            return $(this).find('.column').text();
        }).get();

        /*remove default value*/
        visible_columns.shift();

        console.log(visible_columns);
        var page_size = $('#gridsort-page_size').val();
        var theme = $('#gridsort-theme').val();
        var default_columns = $('#gridsort-default_columns').val();
        if (!($('#grid-sort-form').find('.has-error').length)) {
            $.ajax({
                type: "post",
                url: baseUrl + "grid/options/settings",
                data: {
                    class_name: class_name,
                    page_size: page_size,
                    theme: theme,
                    default_columns: default_columns,
                    visible_columns: visible_columns
                }
            }).done(function (data) {
                try {
                    window.location.reload();
                } catch (e) {
                }

            }).error(function (data) {
            });
        }
    });


    /**
     * Reset
     */
    $('.grid-reset').click(function () {

        $.ajax({
            type: 'post',
            url: baseUrl + 'grid/options/reset',
            data: {
                class_name: class_name
            }
        }).done(function (data) {
            try {
                window.location.reload();
            } catch (e) {
            }

        }).error(function (data) {
        });
    });


    /*todo not finish */
    var Modal = (function (parent, $) {
        var stacked = parent.stacked = parent.stacked || {};

        /**
         * Init Modal Stacked.
         *
         */
        stacked.init = function (name) {
            $(name).on('hidden.bs.modal', function( event ) {
                $(this).removeClass('fv-modal-stack');
                $('body').data('fv_open_modals', $('body').data('fv_open_modals') - 1);

                // add by emalherbi - create scroll automatic when back to modal or $('body') - for bootstrap 3.3.4.
                if (Number($('body').data('fv_open_modals')) <= 0) {
                    $('body').css('overflow', 'auto');
                } else {
                    $('.modal').css('overflow', 'auto');
                }
            });
            $(name).on('shown.bs.modal', function ( event ) {
                // keep track of the number of open modals

                if (typeof($('body').data('fv_open_modals')) == 'undefined') {
                    $('body').data('fv_open_modals', 0);
                }
                $('body').data('fv_open_modals', $('body').data('fv_open_modals') + 1);

                // if the z-index of this modal has been set, ignore.

                if ($(this).hasClass('fv-modal-stack')) {
                    return;
                }

                $(this).addClass('fv-modal-stack');
                $(this).css('z-index', 1040 + (10 * $('body').data('fv_open_modals')));

                $('.modal-backdrop').not('.fv-modal-stack').css('z-index', 1039 + (10 * $('body').data('fv_open_modals')));
                $('.modal-backdrop').not('fv-modal-stack').addClass('fv-modal-stack');

                // add by emalherbi - $('body') always overflow if exist modal - for bootstrap 3.3.4.
                $('body').css('overflow', 'hidden');
            });
        };

        return parent;
    })(Modal || {}, jQuery);


        Modal.stacked.init('#w4' );
        Modal.stacked.init('#field_settings');


        $('#openBtn').click(function() {
            $('#w4').modal({ show:true });
        });

});
