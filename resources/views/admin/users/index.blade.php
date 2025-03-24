@extends('layouts.app')


@section('content')
    @include('layouts.additionalscripts.adddatatable')


    <div id="content" class="padding-20">

        <div class="flex items-center justify-end">

            @can('user.add')
                <a href="{{ route('admin.users.create') }}" class="btn-primary !font-normal">
                    <i class="fa-solid fa-plus"></i> Create User
                </a>
            @endcan

        </div>

        <div class=" mt-2">
            <table id="dataTable"
                class="shadow-sm bg-white rounded-lg overflow-hidden  w-full border-collapse bg-gray-50 !border-gray-300 text-sm">
                <thead>
                    <tr>
                        <th class=" w-1/4">
                            <div class="form-label p-2 !m-0"> Full Name</div>
                        </th>
                        <th class="">
                            <div class="form-label p-2 !m-0"> Email</div>
                        </th>
                        <th class="">
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
                ajax: "{{ route('admin.users.index') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                initComplete: function(settings, json) {
                    $('.dataTables_filter')
                        .addClass(' mb-2')
                    $('.dataTables_length label')
                        .addClass('flex items-center gap-2 text-sm');
                    $('.dataTables_length label select')
                        .addClass('form-input !w-16 text-sm');
                    $('.dataTables_info')
                        .addClass(' text-sm');

                    $('.dataTables_filter label').contents().filter(function() {
                        return this.nodeType === 3;
                    }).remove();
                    $('.dataTables_filter input').addClass('form-input text-sm').attr('placeholder',
                        'Search users...');
                },
                headerCallback: function(thead, data, start, end, display) {
                    // Customize header cells (th elements)
                    $(thead).find('th').addClass('!border-b !p-1 !border-gray-300 text-left')
                },



            });




        });
    </script>
@endsection
