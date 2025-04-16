


@extends('layouts.app')

@section('pagelevelstyle')
    @include('layouts.additionalscripts.adddatatable')
    @include('layouts.additionalscripts.addselect2')
@endsection
@section('content')
    <div id="content" class="padding-20">

        <div class="flex items-center justify-end">

            @can('batches.add')
                <a href="{{ route('admin.batches.create') }}" class="btn-primary !font-normal">
                    <i class="fa-solid fa-plus"></i> Create Batch
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
                            <div class="form-label p-2 !m-0">Batch Title</div>
                            <div class="pl-2 pr-8">
                                <input name="batch_title" id="batch_title"
                                    class="form-input text-xs !font-normal filter-input"></input>

                            </div>
                        </th>
                        <th>
                            <div class="form-label p-2 !m-0">Course Name</div>
                            <div class="pl-2 pr-8">
                                <input name="course_name" id="course_name"
                                    class="form-input text-xs !font-normal filter-input"></input>

                            </div>
                        </th>
           

                        <th class="text-center">
                            <div class="form-label p-2 !m-0">Total Marks</div>
                            <div class="pl">
                                <input name="total_marks" id="total_marks"
                                    class="form-input text-xs !font-normal filter-input"></input>

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
            const changeStatusRoute = "{{ route('admin.batches.changeStatus') }}";


            // Initialize DataTable
            $("#dataTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.batches.index') }}"
                },
                columns: [{
                        data: 'batch_title',
                        name: 'batch_title'
                    },
                   {
                        data: 'course_name',
                        name: 'c.course_name'
                    },
                    {
                        data: 'total_marks',
                        name: 'total_marks'
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
                ...dataTableStyling
            });

            createSelect2("#parent_id", "{{ route('admin.categories.list') }}", {
                'onlyParent': true
            });


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

            // ✅ Filter Input Events
            $('.filter-input, .select2-selection__rendered, .select2-selection__arrow').on('input change', function() {
                let columnIndex = $(this).closest('th').index();
                $(this).closest('table').DataTable().column(columnIndex).search(this.value).draw();
            }).on('click', function(event) {
                event.stopPropagation();
            });

        });
    </script>
@endsection
