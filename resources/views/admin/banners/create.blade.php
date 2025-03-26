@extends('layouts.app')

@section('content')
    <div id="content">
        <form id="form" enctype="multipart/form-data"
            action="{{ isset($banner->id) ? route('admin.banners.update', ['banner' => $banner->id]) : route('admin.banners.store') }}"
            method="POST" class="space-y-6">
            @if (isset($banner->id))
                @method('PUT')
            @endif
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label for="name" class="form-label required">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter Full Name" class="form-input"
                        value="{{ @$banner->name }}">
                </div>
                <div>
                    <label for="description" class="form-label">Description</label>
                    <input type="description" name="description" id="description" placeholder="write description"
                        class="form-input" value="{{ @$banner->description }}">
                </div>
                <div>
                    <label for="file" class="form-label required">Image</label>
                    <input type="file" name="file" id="file" class="form-file" accept="image/*">

                </div>
                <div class="bg-white p-2 px-3 rounded-lg ">
                    <label class="form-label !ml-0">Saved Image</label>
                    <img class="w-20 aspect-square" src="{{ isset($banner->path) ? asset($banner->path) : '' }}"
                        alt="Image" />

                </div>
            </div>

            <div class="flex gap-2 w-fit ml-auto sticky bottom-0 py-3">
                <a href='{{ route('admin.banners.index') }}' type="button" class="btn-default">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Back
                </a>
                <button type="submit" class="btn-primary">
                    Submit <i class="fa-solid fa-arrow-right ml-2"></i>
                </button>
            </div>
        </form>
    </div>
    </div>
@endsection

@section('pagelevelscript')
    <script>
        $(document).ready(function() {

            let rules = {
                name: {
                    required: true,
                    minlength: 5,
                    maxlength: 100
                },
                description: {
                    maxlength: 255
                },
            };


            $("#form").validate({
                rules: rules,
                messages: {
                    name: {
                        required: "Banner Name is required",
                    },
                    description: {
                        maxlength: "Description must be less than 255 characters",
                    },
                },
                errorElement: "span",
                errorClass: "text-red-500 text-xs",
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                }

            });
        });
    </script>
@endsection
