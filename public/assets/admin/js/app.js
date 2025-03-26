// const dataTableParams = {
//     initComplete: function (settings, json) {
//         $('.dataTables_filter')
//             .addClass(' mb-2')
//         $('.dataTables_length label')
//             .addClass('flex items-center gap-2 text-sm');
//         $('.dataTables_length label select')
//             .addClass('form-input !w-16 text-sm');
//         $('.dataTables_info')
//             .addClass(' text-sm');
//         $('.sorting,.sorting_asc,.sorting_desc')
//             .addClass(
//                 ' before:!content-["▲"] after:!content-["▼"] after:!right-5 text-xs before:!top-[9.5px] after:!bottom-[9.5px] before:!right-5 '
//             );

//         $('.dataTables_filter label').contents().filter(function () {
//             return this.nodeType === 3;
//         }).remove();
//         $('.dataTables_filter input').addClass('form-input text-sm').attr('placeholder',
//             'Search...');
//     },
//     headerCallback: function (thead, data, start, end, display) {
//         // Customize header cells (th elements)
//         $(thead).find('th').addClass('!border-b !p-1 !border-gray-300 text-left ')
//         $(thead).find('th:not(:last)').addClass('!border-b !border-r !p-1 !border-gray-300 text-left ')
//     },
//     rowCallback: function (tbody, data) {
//         // Add 'table-active' class to the row when it's hovered
//         $(tbody).find('td:not(:last)').addClass('border-r !border-gray-300')

//     },
//     drawCallback: function () {
//         // Style Previous button
//         $('#dataTable_previous')
//             .removeClass('paginate_button previous text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 text-gray-500 bg-gray-100 border border-gray-300 cursor-not-allowed cursor-pointer')
//             .addClass('inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md ' +
//                 ($('#dataTable_previous').hasClass('disabled') ? 'text-gray-500 bg-gray-100 border border-gray-300 cursor-not-allowed' :
//                     'text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 cursor-pointer'));

//         // Style page numbers
//         $('#dataTable_paginate .paginate_button')
//             .removeClass('paginate_button')
//             .addClass('inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md')
//             .each(function () {
//                 if ($(this).hasClass('current')) {
//                     $(this).removeClass('text-gray-700 bg-white border-gray-300 hover:bg-gray-100')
//                         .addClass('text-white bg-[#023c40] border border-[#023c40] cursor-pointer');
//                 } else {
//                     $(this).addClass('text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 cursor-pointer');
//                 }
//             });

//         // Style Next button
//         $('#dataTable_next')
//             .removeClass('paginate_button next text-gray-500 bg-gray-100 border border-gray-300 cursor-not-allowed text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 cursor-pointer')

//             .addClass('inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md ' +
//                 ($('#dataTable_next').hasClass('disabled') ? 'text-gray-500 bg-gray-100 border border-gray-300 cursor-not-allowed' :
//                     'text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 cursor-pointer'));

//         // Style the container
//         $('#dataTable_paginate')
//             .removeClass('paging_simple_numbers')
//             .addClass('flex items-center justify-center space-x-2 py-4');

//         // Style the span
//         $('#dataTable_paginate span').addClass('flex space-x-1');
//     }

// }

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

