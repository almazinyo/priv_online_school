$(document).ready(function () {
    "use strict";
    var column_name, class_name, visible_columns;

    $(".field_settings").on("click", function () {

        column_name = $(this).find("a").data("column-name");
        class_name = $(this).find("a").data("class-name");

        $('#title-field-settings').html("Settings " + column_name);

        visible_columns = $('.sortable-visible li').map(function () {
            return $(this).find('.column').text();
        }).get();

        /*remove default value*/
        visible_columns.shift();


        $.ajax({
            type: 'post',
            url: baseUrl + 'grid/options/field-settings-used-data',
            data: {
                visible_columns: visible_columns,
                class_name: class_name,
                column_name: column_name
            }
        }).done(function (data) {
            try {
                var obj = JSON.parse(data);
                console.log(obj);

                for (var key in JSON.parse(data)) {
                    $('#fieldsettings-' + key).val(obj[key])
                }
            } catch (e) {

            }
        }).error(function (data) {

        });


        $('#save-filed-settings').click(function () {


            /*remove default value*/
            visible_columns.shift();

            var format = $('#fieldsettings-format').val();
            var search = $('#fieldsettings-search').val();
            var label = $('#fieldsettings-label').val();
            var width_column = $('#fieldsettings-width_column').val();


            /**
             * check validation form
             */
            if (!($('#field-settings-form').find('.has-error').length)) {
                $.ajax({
                    type: 'post',
                    url: baseUrl + 'grid/options/field-settings',
                    data: {
                        visible_columns: visible_columns,
                        column_name: column_name,
                        format: format,
                        search: search,
                        label: label,
                        width_column: width_column,
                        class_name: class_name
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
    });
});