
const dataTableParams = {
    initComplete: function (settings, json) {
        // Remove the "Search:" label
        $('.dt-search label').contents().filter(function () {
            return this.nodeType === 3; // Target text nodes
        }).remove();

        $('.dt-search input').addClass('form-input text-sm').attr('placeholder', 'Search...');
        $('.dt-length label').addClass('inline gap-2 text-sm');
        $('.dt-length select').addClass('form-input !w-16 text-sm');
        $('.dt-info').addClass('text-sm');

    },
    headerCallback: function (thead, data, start, end, display) {
        // Customize header cells (th elements)
        $(thead).find('th').addClass('!p-1 !border-gray-300 text-left');
        $(thead).find('th:not(:last)').addClass(' !border-r !p-1 !border-gray-300 text-left');
    },
    rowCallback: function (tbody, data) {
        // Add 'table-active' class to the row when it's hovered
        $(tbody).find('td:not(:last)').addClass('!border-r !border-gray-300');
    },

};


$(document).on('click', '.delete', function (e) {
    e.preventDefault();
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const path = $(this).attr('href');
    $.ajax({
        url: path,
        method: 'delete',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (response) {
            if (response.success) {
                $("#dataTable").DataTable().ajax.reload();
            }

        }
    });
});

// $(document).ready(function () {
//     $(document).on('input change', '.filter-input', function () {
//         let columnIndex = $(this).closest('th').index();
//         table.column(columnIndex).search(this.value).draw();
//     });

//     $(document).on('click', '.filter-input', function (event) {
//         event.stopPropagation();
//     });
//     $('.select2').select2({ width: '100%' });


// });