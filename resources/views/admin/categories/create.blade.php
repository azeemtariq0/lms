@extends('layouts.app')

@section('content')
    <div id="content">
        <form id="form" enctype="multipart/form-data"
            action="{{ isset($category->id) ? route('admin.categories.update', ['category' => $category->id]) : route('admin.categories.store') }}"
            method="POST" class="space-y-6">
            @if (isset($category->id))
                @method('PUT')
            @endif
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label for="parent_id" class="form-label ">Parent</label>
                    <select name="parent_id" id="parent_id" class="form-input">
                        <option value="">No Parent</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ isset($category) ? ($cat->id == $category->parent_id ? 'selected' : '') : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>

                </div>
                <div>
                    <label for="name" class="form-label required">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter Full Name" class="form-input"
                        value="{{ @$category->name }}">
                </div>

                <div>
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-input">
                        <option value="1" {{ isset($category) ? ($category->status == 1 ? 'selected' : '') : '' }}>
                            Active
                        </option>
                        <option value="0" {{ isset($category) ? ($category->status == 0 ? 'selected' : '') : '' }}>
                            Inactive
                        </option>
                    </select>
                </div>
            </div>
            <div class="flex gap-2 w-fit ml-auto sticky bottom-0 py-3">
                <a href='{{ route('admin.categories.index') }}' type="button" class="btn-default">
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
                },
            };


            $("#form").validate({
                rules: rules,
                messages: {
                    name: {
                        required: "Category Name is required",
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
