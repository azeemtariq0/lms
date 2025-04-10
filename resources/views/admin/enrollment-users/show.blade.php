@extends('layouts.app')


@section('content')
<div id="content" class="padding-20">

    <div class="row">

        <div class="col-md-6">

            <!-- ------ -->
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>User Info</strong>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {{ $user->name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Email:</strong>
                                {{ $user->email }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Roles:</strong>
                                @if(!empty($roles))
                                @foreach($roles as $v)
                                <span class="label label-info" style="font-size: 14px !important;">{{ $v }}</span>
                                <!-- <label class="badge badge-success">{{ $v }}</label> -->
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    

                </div>

            </div>
            <!-- /----- -->

        </div>



    </div>

</div>


@endsection