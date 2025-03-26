@extends('layouts.app')


@section('content')
    @include('layouts.additionalscripts.adddatatable')

    <div id="content" class="padding-20">

        <div class="flex items-center justify-end">

            @can('categories.add')
                <a href="{{ route('admin.categories.create') }}" class="btn-primary !font-normal">
                    <i class="fa-solid fa-plus"></i> Create Category
                </a>
            @endcan

        </div>

        <div class=" mt-2">
            <table id="dataTable"
                class="shadow-sm bg-white rounded-lg overflow-hidden  w-full border-collapse bg-gray-50 !border-gray-300 text-sm">
                <thead>
                    <tr>
                        <th>
                            <div class="form-label p-2 !m-0">Parent Category</div>
                        </th>
                        <th>
                            <div class="form-label p-2 !m-0">Sub Category</div>
                        </th>
                        <th>
                            <div class="form-label p-2 !m-0">Status</div>
                        </th>
                        <th class="!w-40">
                            <div class="form-label p-2 !m-0 text-center"> Action</div>
                        </th>

                    </tr>
                </thead>
                <tbody>
                </tbody>

            </table>

        </div>
        <!-- /panel content -->

    </div>
@endsection

@section('pagelevelscript')
    <script type="text/javascript">
        $(function() {

            var table = $("#dataTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.categories.index') }}",
                columns: [{
                        data: 'parent_name',
                        name: 'parent.name'
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
