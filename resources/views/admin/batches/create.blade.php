@extends('layouts.app')


@section('content')
    <div id="content">
        <form id="form" enctype="multipart/form-data"
            action="{{ isset($batches->id) ? route('admin.batches.update', ['batches' => $batches->id]) : route('admin.batches.store') }}"
            method="POST" class="space-y-6">
            @if (isset($batches->id))
                @method('PUT')
            @endif
            @csrf
            
            <div class="grid grid-cols-2 gap-6">

                <div>
                    <label for="name" class="form-label">Batch Title</label>
                    <input type="text" name="batch_title" id="batch_title"  class="form-input" placeholder="Batch Title" value="{{ @$batches->batch_title }}" />
                </div>

                <div>
                    <label for="name" class="form-label required">Course</label>

                    <select type="text" name="course_id" id="course_id"  class="form-input">
                        <option value=""></option>
                        @foreach($courses as $value)
                        <option {{ @$batches->course_id==$value->id ? 'selected' : ''}}  value="{{ $value->id }}">{{ $value->course_name }}</option>
                        @endforeach
                    </select>

                </div>
               
            </div>





            <div class="grid grid-cols-2 gap-6">

                <div>
                    <label for="name" class="form-label">Course Duration</label>
                    <input type="text" name="course_duration" id="course_duration" placeholder="Course Duration"  class="form-input" value="{{ @$batches->course_duration }}">
                </div>
                <div>
                    <label for="name" class="form-label">Course Duration Days</label>
                    <input type="number" name="course_duration_days" id="course_duration_days"  class="form-input" value="{{ @$batches->course_duration_days }}">
                </div>
            </div>


              <div class="grid grid-cols-2 gap-6">

                <div>
                    <label for="name" class="form-label">No of Questions</label>
                    <input type="text" name="no_of_questions" id="no_of_questions" placeholder="No of Questions"  class="form-input" value="{{ @$batches->no_of_questions }}">
                </div>
                <div>
                    <label for="name" class="form-label">Total Marks</label>
                    <input type="number" name="total_marks" id="total_marks" placeholder="Add Course (Urdu)"  class="form-input" value="{{ @$batches->total_marks }}">
                </div>
            </div>




            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label for="name" class="form-label">Time Limit</label>
                    <input type="text" name="time_limit" id="time_limit" placeholder="Time Limit"  class="form-input" value="{{ @$batches->time_limit }}">
                </div>
                <div>
                    <label for="name" class="form-label">No of Easy Questions</label>
                    <input type="number" name="no_of_easy_question" id="no_of_easy_question" placeholder="Easy Questions"  class="form-input" value="{{ @$batches->no_of_easy_question }}">
                </div>
            </div>



              <div class="grid grid-cols-2 gap-6">
                <div>
                    <label for="name" class="form-label">No of Medium Questions</label>
                    <input type="number" name="no_of_medium_question" id="no_of_medium_question" placeholder="Medium Question"  class="form-input" value="{{ @$batches->no_of_medium_question }}">
                </div>
                <div>
                    <label for="name" class="form-label">No of Hard Questions</label>
                    <input type="number" name="no_of_medium_question" id="no_of_medium_question" placeholder="Hard Questions"  class="form-input" value="{{ @$batches->no_of_medium_question }}">
                </div>
            </div>



              <div class="grid grid-cols-2 gap-6">
                <div>
                    <label for="name" class="form-label">Year</label>
                    <input type="text" name="year" id="year" placeholder="Year"  class="form-input" value="{{ @$batches->year }}">
                </div>
                <div>
                    <label for="name" class="form-label">Month</label>
                    <input type="text" name="month" id="month" placeholder="Month"  class="form-input" value="{{ @$batches->month }}">
                </div>
            </div>



            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label for="name" class="form-label">Start Date</label>
                    <input type="text" name="start_date" id="start_date" placeholder="Start Date"  class="form-input" value="{{ @$batches->start_date }}">
                </div>
                <div>
                    <label for="name" class="form-label">Month</label>
                    <input type="text" name="end_date" id="end_date" placeholder="End date"  class="form-input" value="{{ @$batches->end_date }}">
                </div>
            </div>



            <div class="flex gap-2 w-fit ml-auto sticky bottom-0 py-3">
                <a href='{{ route('admin.batches.index') }}' type="button" class="btn-default">
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
                description: {
                    maxlength: 255
                },
            };


            $("#form").validate({
                rules: rules,
                messages: {
                    name: {
                        required: "Category Name is required",
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