@extends('layouts.app')

@section('pagelevelstyle')
    @include('layouts.additionalscripts.adddatatable')
    @include('layouts.additionalscripts.addselect2')
@endsection
@section('content')

@section('content')
    <div id="content" class="padding-20">

        <div class="flex items-center justify-end">

            @can('banners.add')
                <a href="{{ route('admin.banners.create') }}" class="btn-primary !font-normal">
                    <i class="fa-solid fa-plus"></i> Create Banner
                </a>
            @endcan

        </div>

        <div class=" mt-2">
            <table id="dataTable"
                class="shadow-sm bg-white rounded-lg overflow-hidden  w-full border-collapse bg-gray-50 !border-gray-300 text-sm">
                <thead>
                    <tr>
                        <th>
                            <div class="form-label p-2 !m-0">Name</div>
                        </th>

                         <th>
                            <div class="form-label p-2 !m-0">Description</div>
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
        $(document).ready(function() {

            const csrfToken = "{{ csrf_token() }}";
            const changeStatusRoute = "{{ route('admin.banners.changeStatus') }}";

            var table = $("#dataTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.banners.index') }}",
                columns: [{
                    data: 'name',
                    name: 'name'
                },{
                    data: 'description',
                    name: 'description'
                },{
                    data: 'status',
                    name: 'status'
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }, ],
                ...dataTableStyling

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

     });

    </script>
@endsection
