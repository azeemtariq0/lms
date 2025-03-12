@extends('layouts.app')


@section('content')

@php $isView = ($data['page_management']['slug']=='View') ? "readonly" : "";    @endphp


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

                    
                            @if(!isset($banner->id))
                             <form  action="{{ route('admin.banners.store')}}" method="post" id="users_form">
                            @else
                               <form  action="{{ route('admin.banners.update', ['banner' => $banner->id]) }}" method="PATCH" id="banners_form">

                            @endif

                            @csrf
                        <fieldset>
                            <!-- required [php action request] -->
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12">
                                        <label>Name *</label>
                                        <input type="text" {{ $isView }} name="name" placeholder="Name" value="{{ @$banner->name }}" class="form-control required">
                            
                                    </div>

                                </div>
                            </div>

                        
        
                        </fieldset>

                        @if(!$isView)

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info margin-top-30 pull-right">
                                   <i class="fa fa-check"></i>  <?= (!isset($banner->id)) ? "Save" : "Update" ?>
                               </button>
                           </div>
                       </div>

                       @endif

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