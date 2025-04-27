@extends('layouts.app')


@section('content')




    <div id="content">
        <form id="form" enctype="multipart/form-data"
            action="{{ isset($event->id) ? route('admin.events.update', ['event' => $event->id]) : route('admin.events.store') }}"
            method="POST" class="space-y-6">
            @if (isset($event->id))
                @method('PUT')
            @endif
            @csrf
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                <div>
                    <label for="name" class="form-label">Batch Title</label>
                    <select type="text" name="batch_id" id="batch_id"  class="form-input">
                        <option value=""></option>
                        @foreach($batches as $value)
                        <option {{ @$event->batch_id==$value->id ? 'selected' : ''}}  value="{{ $value->id }}">{{ $value->batch_title }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="name" class="form-label required">Course</label>

                    <select type="text" name="course_id" id="course_id"  class="form-input">
                        <option value=""></option>
                        @foreach($courses as $value)
                        <option {{ @$event->course_id==$value->id ? 'selected' : ''}}  value="{{ $value->id }}">{{ $value->course_name }}</option>
                        @endforeach
                    </select>

                </div>
               
            </div>



            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="form-label">Start Date</label>
                    <input type="text" name="start_date" id="start_date" placeholder="Start Date"  class="form-input dtpDate" autocomplete="off" value="{{ stdDate(@$event->start_date) }}">
                </div>
                <div>
                    <label for="name" class="form-label">End Date</label>
                    <input type="text" name="end_date" id="end_date" placeholder="End date"  class="form-input dtpDate" autocomplete="off" value="{{ stdDate(@$event->end_date) }}">
                </div>
            </div>


            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label for="name" class="form-label">Destination</label>
                    <textarea type="text" name="destination" id="destination" placeholder="Destination"  class="form-input" autocomplete="off">{{ @$event->destination }}</textarea>
                </div>
                
            </div>



            <div class="flex gap-2 w-fit ml-auto sticky bottom-0 py-3">
                <a href='{{ route('admin.events.index') }}' type="button" class="btn-default">
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