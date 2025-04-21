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

            <div class="grid grid-cols-1 gap-12">
                <div>
                    <button type="button"  class="btn btn-primary float-right" id="fetch-user" >Add User</label>
            
                </div>

            </div>

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
                                        {{ isset($user->permission_id) && in_array($id, json_decode($user->permission_id,true)) ? 'checked' : '' }}>
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





<!-- Main modal -->
<div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    ORG User Form
                </h3>
                <button type="button" class="text-gray-400  btnClose hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="#">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">



                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                    </div>



                    <!-- <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                    </div>
                    <div>
                        <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                        <input type="text" name="brand" id="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Product brand" required="">
                    </div>
                    <div>
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                    </div>
                    <div>
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Select category</option>
                            <option value="TV">TV/Monitors</option>
                            <option value="PC">PC</option>
                            <option value="GA">Gaming/Console</option>
                            <option value="PH">Phones</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write product description here"></textarea>                    
                    </div> -->
                </div>
                <button type="submit" class="btn btn-success">
                
                    Fetch
                </button>
            </form>
        </div>
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



    $('#fetch-user').on('click',function(){
        $('#defaultModal').show('slow');
    });

     $('.btnClose').on('click',function(){
        $('#defaultModal').hide('slow');
    });


// Get User Form ORG System
    $('#submitBtn').on('click',function (argument) {
        var name = $('#org_name').val();
        $.ajax({
            url:'https://aws-stage.dibaadm.com:9080/api/auth/search_user',
            type:'post',
            dataType:'json',
            data:{'name':name,"_token": "{{ csrf_token() }}"},
            success:function function_name(response) {
                  console.log(response);
            }
        });
    });



    document.addEventListener("DOMContentLoaded", function(event) {
    document.getElementById('defaultModalButton').click();
});
</script>

@endsection
