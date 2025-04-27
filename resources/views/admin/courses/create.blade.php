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

            <!-- Tabs Header -->
            <div
                class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px" id="tabs-nav">
                    <li class="me-2">
                        <a href="#general"
                            class="tab-link inline-block p-4 text-blue-600 !border-b-2 !border-blue-600 rounded-t-lg active"
                            aria-current="page">General</a>
                    </li>
                    <li class="me-2">
                        <a href="#lectures"
                            class="tab-link inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Lectures</a>
                    </li>
                    <li class="me-2">
                        <a href="#attachments"
                            class="tab-link inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Attachments</a>
                    </li>
                </ul>
            </div>

            <!-- Tabs Content -->
            <div id="tabs-content">

                <!-- General Tab -->
                <div id="general" class="tab-pane">
                    <div class="grid grid-cols-2 gap-6 mb-4">

                        <div>
                            <label for="name" class="form-label">Category</label>
                            <select type="text" name="category_id" required id="category_id" class="form-input">
                                <option value=""></option>
                                @foreach ($categories as $value)
                                    <option {{ @$course->category_id == $value->id ? 'selected' : '' }}
                                        value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="name" class="form-label required">Mollimeen</label>

                            <select type="text" name="mollim_id" id="mollim_id" class="form-input">
                                <option value=""></option>
                                @foreach ($users as $value)
                                    <option {{ @$course->mollim_id == $value->id ? 'selected' : '' }}
                                        value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>




                    <div class="grid grid-cols-2 gap-6 mb-4">

                        <div>
                            <label for="name" class="form-label">Course Title</label>
                            <input type="text" name="course_name" id="course_name" placeholder="Add Course"
                                class="form-input" value="{{ @$course->course_name }}">
                        </div>
                        <div>
                            <label for="name" class="form-label">Course Title (Urdu)</label>
                            <input type="text" name="course_name_ur" id="course_name_ur" placeholder="Add Course (Urdu)"
                                class="form-input" value="{{ @$course->course_name_ur }}">

                        </div>
                    </div>


                    <div class="grid grid-cols-2 gap-6 mb-4">
                        <div>
                            <label for="name" class="form-label">Course Requirement</label>
                            <input type="text" name="course_requirement" id="course_requirement" placeholder="Add Course"
                                class="form-input" value="{{ @$course->course_requirement }}">
                        </div>
                        <div>
                            <label for="name" class="form-label">Course Detail</label>
                            <input type="text" name="course_detail" id="course_detail" placeholder="Add Course (Urdu)"
                                class="form-input text-right" value="{{ @$course->course_detail }}">

                        </div>
                    </div>



                    <div class="grid grid-cols-2 gap-6 mb-4">
                        <div>
                            <label for="name" class="form-label">Location</label>
                            <select type="text" name="location_id" id="location_id" class="form-input">
                                <option></option>
                            </select>
                        </div>

                        <div>
                            <label for="name" class="form-label required">Status</label>
                            <select name="status" id="status" class="form-input">
                                <option value="0">Inactive</option>
                                <option {{ @$course->status == 1 ? 'selected' : '' }} value="1">Active</option>
                            </select>
                        </div>

                    </div>


                    <div class="grid grid-cols-2 gap-6 mb-4">

                        <div>
                            <label for="file" class="form-label">Image</label>
                            <input type="file" name="file" id="file" class="form-file" accept="image/*">

                        </div>
                        <div class="bg-white p-2 px-3 rounded-lg ">
                            <label class="form-label !ml-0">Saved Image</label>
                            <img class="w-20 aspect-square" id="preview"
                                src="{{ isset($course->path) ? asset($course->path) : asset('assets/clip.png') }}"
                                alt="Image" />

                        </div>
                    </div>
                </div>

                {{-- <!-- Lectures Tab -->
                <div id="lectures" class="tab-pane hidden">
                    <div class="bg-white p-6 rounded-md border border-gray-200 space-y-6">
                        <div class="flex items-center justify-between">
                            <div>

                                <h3 class="text-2xl font-bold text-gray-800">Lectures</h3>
                                <p class="text-gray-500 text-sm">Add your curriculum lecture details below.</p>
                            </div>
                            <button type="button" id="add-lecture" class="btn-primary">+ Add Lecture</button>
                        </div>

                        <div id="lecture-fields" class="space-y-4">
                            <div class="lecture-group bg-gray-50 p-4 rounded-lg border border-gray-200 space-y-4">
                                <div class="grid grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Lecture Title</label>
                                        <input type="text" name="lecture_title[]" placeholder="Enter Title"
                                            class="form-input w-full" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Description</label>
                                        <input type="text" name="lecture_description[]"
                                            placeholder="Enter Description" class="form-input w-full" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Duration (in
                                            minutes)</label>
                                        <input type="number" name="lecture_duration[]" placeholder="e.g. 45"
                                            class="form-input w-full" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div> --}}
                <!-- Lectures Tab -->
                <div id="lectures" class="tab-pane hidden">
                    <div class="bg-white p-6 rounded-md border border-gray-200 space-y-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">Lectures</h3>
                                <p class="text-gray-500 text-sm">Add your curriculum lecture details below.</p>
                            </div>
                            <button type="button" id="add-lecture" class="btn-primary">+ Add Lecture</button>
                        </div>

                        <div id="lecture-fields" class="space-y-4">
                            @if (isset($course->lectures))
                                @foreach ($course->lectures as $lecture)
                                    <div class="lecture-group bg-gray-50 p-4 rounded-lg border border-gray-200 space-y-4">
                                        <div class="grid grid-cols-3 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Lecture
                                                    Title</label>
                                                <input type="text" name="lecture_title[]" placeholder="Enter Title"
                                                    class="form-input w-full" value="{{ $lecture->title }}" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                                <input type="text" name="lecture_description[]"
                                                    placeholder="Enter Description" class="form-input w-full"
                                                    value="{{ $lecture->description }}" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Duration (in
                                                    minutes)</label>
                                                <input type="number" name="lecture_duration[]" placeholder="e.g. 45"
                                                    class="form-input w-full" value="{{ $lecture->duration }}" />
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                {{-- <!-- Attachments Tab -->
                <div id="attachments" class="tab-pane hidden">
                    <div class="bg-white p-6 rounded-md border border-gray-200 space-y-6">
                        <div class="flex items-center justify-between">
                            <div>

                                <h3 class="text-2xl font-bold text-gray-800">Attachments</h3>
                                <p class="text-gray-500 text-sm">Upload any supporting course files below (PDFs, Docs,
                                    etc.)</p>

                            </div>
                            <button type="button" id="add-attachment" class="btn-primary">+ Add Attachment</button>
                        </div>

                        <div id="attachment-fields" class="space-y-4">
                            <div
                                class="attachment-group bg-gray-50 p-4 rounded-lg border border-gray-200 flex items-center justify-between">
                                <input type="file" name="attachments[]" class="form-input w-full" />
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Attachments Tab -->
                <div id="attachments" class="tab-pane hidden">
                    <div class="bg-white p-6 rounded-md border border-gray-200 space-y-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">Attachments</h3>
                                <p class="text-gray-500 text-sm">Upload any supporting course files below (PDFs, Docs,
                                    etc.)</p>
                            </div>
                            <button type="button" id="add-attachment" class="btn-primary">+ Add Attachment</button>
                        </div>

                        <div id="attachment-fields" class="space-y-4">
                            @if (isset($course->attachments))
                                @foreach ($course->attachments as $attachment)
                                    <div
                                        class="attachment-group bg-gray-50 p-4 rounded-lg border border-gray-200 flex items-center justify-between">
                                        <a href="{{ asset('uploads/courses/attachments/' . $attachment->path) }}"
                                            class="text-blue-600" target="_blank">{{ $attachment->path }}</a>
                                
                                        </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-2 w-fit ml-auto sticky bottom-0 py-3">
                <a href='{{ route('admin.courses.index') }}' class="btn-default">
                    <i class="fa-duotone fa-arrow-left mr-2"></i> Back
                </a>
                <button type="submit" class="btn-primary">
                    Submit <i class="fa-duotone fa-arrow-right ml-2"></i>
                </button>
            </div>

        </form>
    </div>

    <!-- jQuery Script -->
    <script>
        $(document).ready(function() {
            $('#add-lecture').click(function() {
                $('#lecture-fields').append(`
        <div class="lecture-group bg-gray-50 p-4 rounded-lg border border-gray-200 space-y-4">
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Lecture Title</label>
                    <input type="text" name="lecture_title[]" placeholder="Enter Title" class="form-input w-full" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <input type="text" name="lecture_description[]" placeholder="Enter Description" class="form-input w-full" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Duration (in minutes)</label>
                    <input type="number" name="lecture_duration[]" placeholder="e.g. 45" class="form-input w-full" />
                </div>
            </div>
        </div>
    `);
            });


            // Add new attachment field
            $('#add-attachment').click(function() {
                $('#attachment-fields').append(`
        <div class="attachment-group bg-gray-50 p-4 rounded-lg border border-gray-200 flex items-center justify-between">
            <input type="file" name="attachments[]" class="form-input w-full" />
        </div>
    `);
            });

            // Form validation
            let rules = {
                category_id: {
                    required: true
                },
                mollim_id: {
                    required: true
                },
                course_name: {
                    required: true
                },
                course_name_ur: {
                    required: true
                },
                slug: {
                    required: true,
                },
                description: {
                    maxlength: 255
                }
            };
            $("#form").validate({
                rules: rules,
                errorElement: "span",
                errorClass: "text-red-500 text-xs",
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                }
            });

            // Preview image
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

        });
        $(document).ready(function() {
            $('.tab-link').click(function(e) {
                e.preventDefault();
                var target = $(this).attr('href');
                $('.tab-link').removeClass('text-blue-600 !border-b-2 !border-blue-600 active');
                $('.tab-pane').addClass('hidden');
                $(this).addClass('text-blue-600 !border-b-2 !border-blue-600 active');
                $(target).removeClass('hidden');
            });
        });
    </script>
@endsection
