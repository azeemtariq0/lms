@extends('layouts.app')


@section('content')



<style>
    

.accordion {
  overflow-anchor: none;
}

.accordion > .card {
  overflow: hidden;
  margin-left: 0px;
}

.accordion > .card:not(:last-of-type) {
  border-bottom: 0;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.accordion button{
     text-align: left;
    font-weight: bold;
}
.accordion > .card:not(:first-of-type) {
  border-top-left-radius: 0;
  border-top-right-radius: 0;

}

.accordion > .card > .card-header {
  border-radius: 0;
  margin-bottom: 0;
}

.accordion h2 {
    margin: 0 0 1px 0;
}
.accordion .col-3{
    float: left;
    width: 300px;
        padding-left: 16px;
    background: #fff;
    margin-left: 10px;
}
.accordion .card-body{
    background: #fff;
}
.accordion .form-check{
    border: 1px solid #ccc;
    padding: 3px;
    line-height: 1;
}
</style>

@if (count($errors) > 0)
<div id="content" class="padding-20">

    <div class="alert alert-danger margin-bottom-30">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
           @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
           @endforeach
       </ul>
   </div>
   @endif


   <div id="content" class="padding-20">

    <div class="row">

        <div class="col-md-12">

            <!-- ------ -->
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>Edit Permission</strong>
                </div>

                <div class="panel-body">

                   <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <fieldset>
                        <!-- required [php action request] -->
                        <input type="hidden" name="action" value="contact_send" />

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-10 col-sm-10">
                                    <label>Name *</label>
                                    <input type="text" name="name"  class="form-control required" value="{{ $permission->name }}">
                                </div>

                            </div>
                        </div>



                         <div class="row">
                                <div class="col-12">
                                    <div class="accordion" id="accordionExample">
                                        <?php foreach($permission->permission as $module_name => $forms): ?>
                                        <div class="card">
                                            <div class="card-header">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#<?php echo str_replace(' ','_',$module_name); ?>">
                                                        <?php echo $module_name; ?>
                                                    </button>
                                                </h2>
                                            </div>

                                            <div id="<?php echo str_replace(' ','_',$module_name); ?>" class="collapse" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <?php foreach($forms as $form_name => $permissions): $route=$permissions[0]['route']; ?>
                                                        <div class="col-3">
                                                            <div class="card card-default">
                                                                <div class="card-header">
                                                                    <p class="card-title"><label><input type="checkbox" class="chkAll" data-route="<?php echo $route; ?>" />&nbsp;<?php echo $form_name; ?></label></p>
                                                                </div>
                                                                <div class="card-body" style="height: 136px; overflow-y: scroll;">
                                                                    <div class="form-group m-0">
                                                                        <?php foreach($permissions as $permission): ?>
                                                                        <div class="form-check">
                                                                            <input id="chk<?php echo $permission['control_access_id']; ?>" data-route="<?php echo $permission['route']; ?>" class="form-check-input" type="checkbox" name="permission[<?php echo $permission['route'];?>][<?php echo $permission['permission_id'];?>]" value="1" <?php echo $permission['selected']?'checked':''?> />
                                                                            <label for="chk<?php echo $permission['control_access_id']; ?>" class="form-check-label"><?php echo $permission['permission_name']; ?></label>
                                                                        </div>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        



                        </fieldset>

                          <div class="row">
                           <div class="col-md-12">
                                <button type="submit" class="btn btn-info margin-top-30 pull-right">
                                   <i class="fa fa-check"></i> Update
                               </button>
                           </div>
                       </div>

                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>



  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap-toggle/css/bootstrap-toggle.min.css') }}">
        <script src="{{ asset('assets/admin/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js') }}"></script>
        <!-- bs-custom-file-input -->
        <script src="{{ asset('assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script type="text/javascript">
        
            $('.chkAll').on('change',(e)=> {
                let obj = e.currentTarget;
                let route = $(obj).data('route');
                let isChecked = $(obj).is(':checked');
                //let objects = $(obj).parents('.card:first').find('.card-body');
                //console.log(objects);
                let objects = $(obj).parents('.card:first').find('.card-body').find('input[type=checkbox]').prop('checked',isChecked);

            });

    </script>

@endsection