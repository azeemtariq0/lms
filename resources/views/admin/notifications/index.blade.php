@extends('layouts.app')


@section('content')
  @include('layouts.additionalscripts.adddatatable')

  <div id="content" class="padding-20">


        <div class="col-md-3 pb-3" style="padding: 10px;">
       <select class="form-control">
           <option>Mark as Read</option>
           <option>Mark Unread</option>
       </select>
     </div>

        <div class=" mt-2">
            <table id="dataTable"
                class="shadow-sm bg-white rounded-lg overflow-hidden  w-full border-collapse bg-gray-50 !border-gray-300 text-sm">
                <thead>
                    <tr>
                        <th class=" w-1/3">
                            <div class="form-label p-2 !m-0">Heading Text</div>
                        </th>
                        <th class=" w-1/3">
                            <div class="form-label p-2 !m-0">Message</div>
                        </th>
                        <th class=" w-1/3">
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
        const csrfToken = "{{ csrf_token() }}";
        const changeStatusRoute = "{{ route('admin.notifications.changeStatus') }}";
        $(function() {

             $("#dataTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.notifications.index') }}"
                },
                columns: [{
                    data: 'heading_text',
                    name: 'heading_text'
                },{
                    data: 'message',
                    name: 'message'
                },{
                    data: 'is_read',
                    name: 'is_read'
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }, ],
                ...dataTableStyling
            });

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


    </script>
@endsection
