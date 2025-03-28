$(document).ready(function () {

    // ✅ Default DataTable Styling
    window.dataTableStyling = {
        initComplete: function () {
            $('.dt-search input').addClass('form-input text-sm').attr('placeholder', 'Search...');
            $('.dt-search label').css({ display: "none" });
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

    $(".accordion-btn").click(function () {
        let target = $(this).data("target");
        let icon = $(this).find("i");
        $(".accordion-content").not(target).slideUp(200);
        $(".accordion-btn i").not(icon).removeClass("rotate-180");
        $(".accordion-btn").not(this).removeClass("!bg-gray-200 !text-black ");
        $(target).slideToggle(200);
        $(this).toggleClass("!bg-gray-200 !text-black ");
        icon.toggleClass("rotate-180");
    });


});

function createSelect2(element, url, options = {}) {

    $(element).select2({
        width: '100%',
        placeholder: "Select Option",
        allowClear: true,
        ajax: {
            url: url,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term,
                    page: params.page || 1,
                    ...options

                };
            },
            processResults: function (data) {
                return {
                    results: data.results.map(function (item) {
                        return {
                            id: item.id,
                            text: item.name
                        };
                    }),
                    pagination: {
                        more: data.pagination.more
                    }
                };
            },
            cache: true
        }
    })

    // ✅ DELETE Datatable Row Event (Reusable)
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
                    $(e.target).closest('table').DataTable().ajax.reload();
                }
            }
        });
    });


}