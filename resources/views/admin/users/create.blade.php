@extends('layouts.app')


@section('content')

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
