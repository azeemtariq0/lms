// app.js

$(document).ready(function () {

    // ✅ Default DataTable Styling
    window.dataTableStyling = {
        initComplete: function () {
            $('.dt-search input').addClass('form-input text-sm').attr('placeholder', 'Search...');
            $('.dt-length label').addClass('inline gap-2 text-sm');
            $('.dt-length select').addClass('form-input !w-16 text-sm');
            $('.dt-info').addClass('text-sm');
        },
        headerCallback: function (thead) {
            $(thead).find('th').addClass('!p-1 !border-gray-300 text-left');
            $(thead).find('th:not(:last)').addClass('!border-r !p-1 !border-gray-300 text-left');
        },
        rowCallback: function (row) {
            $(row).find('td:not(:last)').addClass('!border-r !border-gray-300');
        },
    };

   
});
