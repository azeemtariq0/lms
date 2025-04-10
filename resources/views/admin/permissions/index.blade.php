@extends('layouts.app')


@section('content')
  @include('layouts.additionalscripts.adddatatable')

  <div id="content" class="padding-20">

        <div class="flex items-center justify-end">

            @can('user_permission.add')
                <a href="{{ route('admin.permissions.create') }}" class="btn-primary !font-normal">
                    <i class="fa-solid fa-plus"></i> Create Permission
                </a>
            @endcan

        </div>

        <div class=" mt-2">
            <table id="dataTable"
                class="shadow-sm bg-white rounded-lg overflow-hidden  w-full border-collapse bg-gray-50 !border-gray-300 text-sm">
                <thead>
                    <tr>
                        <th class=" w-1/3">
                            <div class="form-label p-2 !m-0"> Full Name</div>
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

             $("#dataTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.permissions.index') }}"
                },
                columns: [{
                    data: 'name',
                    name: 'name'
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }, ],
                ...dataTableStyling
            });

        });
    </script>
@endsection
