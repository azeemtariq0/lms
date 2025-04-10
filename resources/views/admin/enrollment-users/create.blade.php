@extends('layouts.app')


@section('content')

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
       <div class="colm-md-12 row" style="margin-top: 10px;">
    <div class="col-md-11"></div>
</div>

       <div id="content" class="padding-20">

        <div class="row">

            <div class="col-md-12">

                <!-- ------ -->
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <!-- <div class="row"> -->
                        <strong>{{ $data['page_management']['title'] ?? "" }} <button type="button" class="btn btn-warning pull-right py-1" id="fetch-user" style="margin-top:-8px">Fetch User </button></strong>
                                
                            <!-- </div> -->
                    </div>

                    <div class="panel-body">

                    
                            @if(!isset($user->id))
                             <form  action="{{ route('admin.'.$data['page_management']['url'].'.store')}}" method="post" id="users_form">
                            @else
                               <form  action="{{ route('admin.'.$data['page_management']['url'].'.update', ['user' => $user->id]) }}" method="PATCH" id="users_form">

                            @endif

                            @csrf
                        <fieldset>
                            <!-- required [php action request] -->
                            <input type="hidden" id="soceity_id" name="soceity_id" value="{{ auth()->user()->soceity_id }}" />
                            <input type="hidden" id="block_hidden" value="{{ @$user->block_id }}" />
                            
                            <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                        <label>Name *</label>
                                        <input type="text" name="name" placeholder="Name" value="{{ @$user->name }}" class="form-control required">
                            
                                    </div>

                                </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                        <label>Email *</label>
                                        <input type="email" name="email" placeholder="Email" value="{{ @$user->email }}" class="form-control required">
                                    </div>
                                </div>
                            </div>



                            <!-- <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                        <label>Roles *</label>


                                           <select name="Permission[]" multiple class="form-control select2 required">
                                        @if(!empty($roles))
                                @foreach($roles as $id => $v)
                                   <option value="{{ $id }}">{{$v}}</option>
                                @endforeach
                                @endif


                                     
                                         
                                        </select>
                                       
                                    </div>
                                </div>
                            </div> -->

                    

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>Password *</label>
                                        <input type="password" name="password" placeholder="Password"  class="form-control">

                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>Confirm Password *</label>
                                        <input type="password" name="confirm-password" placeholder="Confirm Password"  class="form-control">
                                    </div>
                                </div>
                            </div>
        
                        </fieldset>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info margin-top-30 pull-right">
                                   <i class="fa fa-check"></i>  <?= (!isset($user->id)) ? "Save" : "Update" ?>
                               </button>
                           </div>
                       </div>
                       </form>

                    </div>

                </div>
                <!-- /----- -->

            </div>



        </div>

    </div>


</div>



<!-- The Modal -->
<div class="modal fade" id="user-modal_">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">ORG User</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                        <label>Email *</label>
                                       <select class="js-example-data-ajax form-control">
                                        <option value="3620194" selected="selected">select2/select2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="user-modal">Close</button>
      </div>

    </div>
  </div>
</div>



<!-- Modal Structure -->
<div class="modal fade" id="user-modal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="userModalLabel">ORG User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body with Inputs -->
      <div class="modal-body">
        <!-- Input Fields -->
        <form id="userForm">

            
          <div class="mb-3">
            <label for="emailInput" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="emailInput" placeholder="Enter your email" required>
          </div>
          <div class="mb-3">
            <label for="usernameInput" class="form-label">Username</label>
            <input type="text" class="form-control" id="usernameInput" placeholder="Enter your username" required>
          </div>
          <div class="mb-3">
            <label for="passwordInput" class="form-label">Password</label>
            <input type="password" class="form-control" id="passwordInput" placeholder="Enter your password" required>
          </div>
          <div class="mb-3">
            <label for="bioTextarea" class="form-label">Bio</label>
            <textarea class="form-control" id="bioTextarea" rows="3" placeholder="Tell us about yourself"></textarea>
          </div>
        </form>
      </div>

      <!-- Modal Footer with Buttons -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="submitBtn">Save Changes</button>
      </div>
    </div>
  </div>
</div>





<script type="text/javascript">
    $('#fetch-user').on('click',function(){
        // search able select2
        $('#user-modal').modal('show');
    });



</script>





@endsection