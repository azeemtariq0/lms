@extends('layouts.app')


@section('content')
    <div id="content">
        <form id="form" enctype="multipart/form-data"
            action="{{ isset($course->id) ? route('admin.courses.update', ['course' => $course->id]) : route('admin.courses.store') }}"
            method="POST" class="space-y-6">
            @if (isset($course->id))
                @method('PUT')
            @endif
            @csrf



            <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px">
                    
                    <li class="me-2">
                        <a href="#" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg dark:text-blue-500 dark:border-blue-500 active" aria-current="page">Home</a>
                    </li>

                    <li class="me-2">
                        <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-blue-300 ">Course Content</a>
                    </li>
              
                </ul>
            </div>

            
            <div class="grid grid-cols-2 gap-6">

                <div>
                    <label for="name" class="form-label">Category</label>
                    <select type="text" name="category_id" required id="category_id"  class="form-input">
                        <option value=""></option>
                        @foreach($categories as $value)
                        <option {{ @$course->category_id==$value->id ? 'selected' : ''}}  value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="name" class="form-label required">Mollimeen</label>

                    <select type="text" name="mollim_id" id="mollim_id"  class="form-input">
                        <option value=""></option>
                        @foreach($users as $value)
                        <option {{ @$course->mollim_id==$value->id ? 'selected' : ''}}  value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>

                </div>
               
            </div>




            <div class="grid grid-cols-2 gap-6">

                <div>
                    <label for="name" class="form-label">Course Title</label>
                    <input type="text" name="course_name" id="course_name" placeholder="Add Course"  class="form-input" value="{{ @$course->course_name }}">
                </div>
                <div>
                    <label for="name" class="form-label">Course Title (Urdu)</label>
                    <input type="text" name="course_name_ur" id="course_name_ur" placeholder="Add Course (Urdu)"  class="form-input" value="{{ @$course->course_name_ur }}">
                        
                </div>
            </div>


             <div class="grid grid-cols-2 gap-6">
                <div>
                    <label for="name" class="form-label">Course Requirement</label>
                    <input type="text" name="course_requirement" id="course_requirement" placeholder="Add Course"  class="form-input" value="{{ @$course->course_requirement }}">
                </div>
                <div>
                    <label for="name" class="form-label">Course Detail</label>
                    <input type="text" name="course_detail" id="course_detail" placeholder="Add Course (Urdu)"  class="form-input text-right" value="{{ @$course->course_detail }}">
                        
                </div>
            </div>



            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label for="name" class="form-label">Location</label>
                    <select type="text" name="location_id" id="location_id" class="form-input">
                        <option></option>
                    </select>
                </div>


                <div>
                    <label for="name" class="form-label">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-input" autocomplete="off" value="{{ @$course->slug }}" />
                </div>
                
                

            </div>



            <div class="grid grid-cols-2 gap-6">
            
                
                <div>
                    <label for="name" class="form-label required">Status</label>
                   <select  name="status" id="status"  class="form-input">
                        <option  value="0">Inactive</option>
                        <option {{ ( @$course->status==1 ? 'selected' : '') }} value="1">Active</option>
                    </select>
                </div>

            </div>


            <div class="grid grid-cols-2 gap-6">

               <div>
                    <label for="file" class="form-label">Image</label>
                    <input type="file" name="file" id="file" class="form-file" accept="image/*">

                </div>
                <div class="bg-white p-2 px-3 rounded-lg ">
                    <label class="form-label !ml-0">Saved Image</label>
                    <img class="w-20 aspect-square" id="preview" src="{{ isset($course->path) ? asset($course->path) : asset('assets/clip.png') }}"
                        alt="Image" />

                </div>
            </div>



            <div class="flex gap-2 w-fit ml-auto sticky bottom-0 py-3">
                <a href='{{ route('admin.courses.index') }}' type="button" class="btn-default">
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
                category_id: {
                    required: true,
                },
                mollim_id: {
                    required: true,
                },
                 course_name: {
                    required: true,
                },
                course_name_ur: {
                    required: true,
                },
                slug: {
                    required: true,
                },
                description: {
                    maxlength: 255
                },
            };


            $("#form").validate({
                rules: rules,
                messages: {
                    name: {
                        category_id: "Category is required",
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





var fileTag = document.getElementById("file"),
preview = document.getElementById("preview");
    
fileTag.addEventListener("change", function() {
  changeImage(this);
});

function changeImage(input) {
  var reader;

  if (input.files && input.files[0]) {
    reader = new FileReader();

    reader.onload = function(e) {
      preview.setAttribute('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

    </script>
@endsection