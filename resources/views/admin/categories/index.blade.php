@extends('layouts.app')

@section('pagelevelstyle')
    @include('layouts.additionalscripts.adddatatable')
    @include('layouts.additionalscripts.addselect2')
@endsection
@section('content')
    <div id="content" class="padding-20">

        <div class="flex items-center justify-end">

            @can('categories.add')
                <a href="{{ route('admin.categories.create') }}" class="btn-primary !font-normal">
                    <i class="fa-solid fa-plus"></i> Create Category
                </a>
            @endcan

        </div>
        <style>
            .filter-input {
                user-select: auto !important;
            }
        </style>
        <div class=" mt-2">
            <table id="dataTable"
                class="shadow-sm bg-white rounded-lg overflow-hidden  w-full border-collapse bg-gray-50 !border-gray-300 text-sm">
                <thead>
                    <tr>
                        <th>
                            <div class="form-label p-2 !m-0">Parent Category</div>
                            <div class="pl-2 pr-8">
                                <select name="parent_id" id="parent_id"
                                    class="select2 form-input text-xs !font-normal filter-input"></select>

                            </div>
                        </th>
                        <th>
                            <div class="form-label p-2 !m-0">Category</div>
                            <div class="pl-2 pr-8">
                                <input type="text" id="sub_category"
                                    class="form-input text-xs !font-normal filter-input">
                            </div>
                        </th>
                        <th>
                            <div class="form-label p-2 !m-0">Status</div>
                            <div class="pl-2 pr-8">
                                <select name="status" id="status" class=" form-input text-xs !font-normal filter-input">
                                    <option value=""></option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </th>
                        <th class="!w-40">
                            <div class="form-label p-2 !m-0 text-center">Action</div>
                        </th>
                    </tr>
                </thead>

                <tbody>
                </tbody>

            </table>

        </div>

    </div>
@endsection

@section('pagelevelscript')
    <script>
        $(document).ready(function() {
            const csrfToken = "{{ csrf_token() }}";
            const changeStatusRoute = "{{ route('admin.categories.changeStatus') }}";

            // Initialize DataTable
            $("#dataTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.categories.index') }}"
                },
                columns: [{
                        data: 'parent_name',
                        name: 'parent_id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                ...window.dataTableStyling
            });


            $('.select2').select2({
                width: '100%',
                placeholder: "Select Parent Category",
                allowClear: true,
                ajax: {
                    url: "{{ route('admin.categories.list') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            })
                        };
                    },
                    cache: true
                }
            })

            // ✅ Change Status Event
            $(document).on('click', '.change-status', function() {
                let id = $(this).data('id');
                let status = $(this).data('status') ? 0 : 1;
                $.ajax({
                    url: changeStatusRoute,
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        id: id,
                        status: status
                    },
                    success: function() {
                        $("#dataTable").DataTable().ajax.reload();
                    }
                });
            });

            // ✅ DELETE Row Event (Reusable)
            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                const path = $(this).attr('href');
                $.ajax({
                    url: path,
                    method: 'delete',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        if (response.success) {
                            $("#dataTable").DataTable().ajax.reload();
                        }
                    }
                });
            });


            // ✅ Filter Input Events
            $('.filter-input, .select2-selection__rendered').on('input change', function() {
                let columnIndex = $(this).closest('th').index();
                $("#dataTable").DataTable().column(columnIndex).search(this.value).draw();
            }).on('click', function(event) {
                event.stopPropagation();
            });

        });
    </script>
@endsection
