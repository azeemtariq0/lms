@extends('layouts.app')


@section('content')
    @include('layouts.additionalscripts.adddatatable')
    @include('layouts.additionalscripts.addselect2')

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
                                <input type="text" id="category" class="form-input text-xs !font-normal filter-input">
                            </div>
                        </th>
                        <th>
                            <div class="form-label p-2 !m-0">Sub Category</div>
                            <div class="pl-2 pr-8">
                                <input type="text" id="sub_category"
                                    class="form-input text-xs !font-normal filter-input">
                            </div>
                        </th>
                        <th>
                            <div class="form-label p-2 !m-0">Status</div>
                            <div class="pl-2 pr-8">
                                <select name="status" id="status" class="select2 form-input !font-normal filter-input">
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
    <script type="text/javascript">
        $(function() {

            var table = $("#dataTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.categories.index') }}",
                },
                columns: [{
                        data: 'parent_name',
                        name: 'parent.name',
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
                    },
                ],
                ...dataTableParams

            });


            $('.filter-input').on('input change', function() {
                let columnIndex = $(this).closest('th').index();
                table.column(columnIndex).search(this.value).draw();
            });

            $('.filter-input').on('click', function(event) {
                event.stopPropagation();
            });


            $(document).on('click', '.change-status', function() {
                let id = $(this).data('id');
                let status = $(this).data('status') ? 0 : 1;
                $.ajax({
                    url: "{{ route('admin.categories.changeStatus') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        status: status
                    },
                    success: function(response) {
                        $("#dataTable").DataTable().ajax.reload();
                    }
                });
            });
        });
    </script>
@endsection
