@extends('layouts.app')


@section('content')


  
  @include('layouts.additionalscripts.adddatatable')


  <div id="content" class="padding-20">

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
      <p>{{ $message }}</p>
    </div>
    @endif
    <div id="panel-1" class="panel panel-default">
      <div class="panel-heading">
        <span class="title elipsis">
          <strong>Manage Users</strong> <!-- panel title -->
        </span>

        <!-- right options -->
        <ul class="options pull-right list-inline">
           @can('user.add')
          <li>
            <a href="{{ route('admin.'.$data['page_management']['url'].'.create')}}" class="btn btn-sm btn-success btn_create_new_user">
              <!-- <i class="et-megaphone"></i> -->
              <span>Create New User</span>
            </a>
          </li>
          @endcan
          <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
          <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
          <li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
        </ul>
        <!-- /right options -->

      </div>

      <!-- panel content -->
      <div class="panel-body">


        <table class="table table-striped table-bordered table-hover table-responsive data-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th width="20%">Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>

      </div>
      <!-- /panel content -->

    </div>
    <!-- /PANEL -->

  </div>

@endsection



@section('pagelevelscript')
<script type="text/javascript">
  $(function () {

    var table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('admin.'.$data['page_management']['url'].'.index') }}",
      columns: [
      {data: 'name', name: 'name'},
      {data: 'email', name: 'email'},
      {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
    });

   


  });
</script>
@endsection