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

            <div class="col-md-6">

                <!-- ------ -->
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <strong>{{ $data['page_management']['title'] ?? "" }}</strong>
                    </div>

                    <div class="panel-body">

                    
                            @if(!isset($user->id))
                             <form  action="{{ route('admin.users.store')}}" method="post" id="users_form">
                            @else
                               <form  action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="PATCH" id="users_form">

                            @endif

                            @csrf
                        <fieldset>
                            <!-- required [php action request] -->
                            <input type="hidden" id="soceity_id" name="soceity_id" value="{{ auth()->user()->soceity_id }}" />
                            <input type="hidden" id="block_hidden" value="{{ @$user->block_id }}" />
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12">
                                        <label>Name *</label>
                                        <input type="text" name="name" placeholder="Name" value="{{ @$user->name }}" class="form-control required">
                            
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12">
                                        <label>Email *</label>
                                        <input type="email" name="email" placeholder="Email" value="{{ @$user->email }}" class="form-control required">
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12">
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
                            </div>

                    

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





<script type="text/javascript">
    

</script>





@endsection