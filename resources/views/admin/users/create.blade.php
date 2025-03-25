@extends('layouts.app')


@section('content')
    {{-- <div id="content" class="padding-20">

        <div class="row">

            <div class="col-md-6">

                <!-- ------ -->
                <div class="panel panel-default">

                    <div class="panel-body">


                        @if (!isset($user->id))
                            <form action="{{ route('admin.users.store') }}" method="post" id="users_form">
                            @else
                                <form action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="PATCH"
                                    id="users_form">
                        @endif

                        @csrf
                        <fieldset>
                            <!-- required [php action request] -->
                            <input type="hidden" id="soceity_id" name="soceity_id"
                                value="{{ auth()->user()->soceity_id }}" />
                            <input type="hidden" id="block_hidden" value="{{ @$user->block_id }}" />
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12">
                                        <label>Name *</label>
                                        <input type="text" name="name" placeholder="Name" value="{{ @$user->name }}"
                                            class="form-control required">

                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12">
                                        <label>Email *</label>
                                        <input type="email" name="email" placeholder="Email" value="{{ @$user->email }}"
                                            class="form-control required">
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12">
                                        <label>Roles *</label>


                                        <select name="Permission[]" multiple class="form-control select2 required">
                                            @if (!empty($roles))
                                                @foreach ($roles as $id => $v)
                                                    <option value="{{ $id }}">{{ $v }}</option>
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
                                        <input type="password" name="password" placeholder="Password" class="form-control">

                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>Confirm Password *</label>
                                        <input type="password" name="confirm-password" placeholder="Confirm Password"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                        </fieldset>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info margin-top-30 pull-right">
                                    <i class="fa fa-check"></i> <?= !isset($user->id) ? 'Save' : 'Update' ?>
                                </button>
                            </div>
                        </div>
                        </form>

                    </div>

                </div>
                <!-- /----- -->

            </div>



        </div>

    </div> --}}
    <div id="content">
        <form id="form"
            action="{{ isset($user->id) ? route('admin.users.update', ['user' => $user->id]) : route('admin.users.store') }}"
            method="POST" class="space-y-6">
            @if (isset($user->id))
                @method('PUT')
            @endif
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label for="name" class="form-label required">Full Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter Full Name" class="form-input"
                        value="{{ @$user->name }}">
                </div>
                <div>
                    <label for="email" class="form-label required">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter Email" class="form-input"
                        value="{{ @$user->email }}">
                </div>
                <div>
                    <label for="password" class="form-label {{ isset($user->id) ? '' : 'required' }}">Current
                        Password</label>
                    <input type="password" name="password" id="password" placeholder="xxxxxx" class="form-input">
                </div>
                <div>
                    <label for="confirm-password" class="form-label {{ isset($user->id) ? '' : 'required' }}">Confirm
                        Password</label>
                    <input type="password" name="confirm-password" id="confirm-password" placeholder="xxxxxx"
                        class="form-input">
                </div>
                <div>
                    <label class="form-label required">Roles</label>
                    <div>
                        @if (!empty($roles))
                            @foreach ($roles as $id => $v)
                                <div class="flex items-center mb-1">
                                    <input id="role_{{ $id }}" type="checkbox" class="form-checkbox"
                                        name="permission_id[]" value="{{ $id }}"
                                        {{ isset($user->permission_id) && in_array($id, $user->permission_id) ? 'checked' : '' }}>
                                    <label for="role_{{ $id }}"
                                        class=" ml-1 text-sm text-gray-800">{{ $v }}</label>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex gap-2 w-fit ml-auto sticky bottom-0 py-3">
                <a href='{{ route('admin.users.index') }}' type="button" class="btn-default">
                    <i class="fa-duotone fa-arrow-left mr-2"></i> Back
                </a>
                <button type="submit" class="btn-primary">
                    Submit <i class="fa-duotone fa-arrow-right ml-2"></i>
                </button>
            </div>
        </form>
    </div>
    </div>

    <script>
        $(document).ready(function() {

            let rules = {
                name: {
                    required: true,
                    minlength: 5,
                    maxlength: 100
                },
                email: {
                    required: true,
                    email: true
                },
                "confirm-password": {
                    equalTo: "#password"
                },
                "permission_id[]": {
                    required: true,

                }
            };

            @if (!isset($user->id)) // insert only validation
                rules["password"] = {
                    required: true,
                };
                rules["confirm-password"] = {
                    required: true,
                    equalTo: "#password"
                };
            @endif

            $("#form").validate({
                rules: rules,
                messages: {
                    name: {
                        required: "Full Name is required",
                    },
                    email: {
                        required: "Email is required",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Password is required",
                    },
                    "confirm-password": {
                        required: "Confirm Password is required",
                        equalTo: "Password and Confirm Password must match"
                    },
                    "permission_id[]": {
                        required: "Select at least one role",

                    }
                },
                errorElement: "span",
                errorClass: "text-red-500 text-xs",
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "permission_id[]") {
                        error.insertAfter($(element).parent().parent());
                    } else {
                        error.insertAfter(element);
                    }
                }

            });
        });
    </script>
@endsection
