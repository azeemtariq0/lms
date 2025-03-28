@extends('layouts.app')

@section('content')
    <div id="content">
        <form id="form"
            action="{{ isset($permission->id) ? route('admin.permissions.update', ['permission' => $permission->id]) : route('admin.permissions.store') }}"
            method="POST" class="space-y-6">
            @if (isset($permission->id))
                @method('PUT')
            @endif
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="form-label required">Name</label>
                    <div class="mt-1">
                        <input type="text" name="name" id="name" class="form-input"
                            value="{{ $permission->name ?? old('name') }}">
                    </div>
                </div>


                <div id="accordion-color" class="rounded-xl overflow-hidden">
                    @foreach ($permission->permission as $module_name => $forms)
                        <div class="permission-group">
                            <h2 id="accordion-color-heading-{{ $module_name }}">
                                <button type="button"
                                    class="bg-white flex items-center justify-between w-full p-3 px-5 text-gray-500 border border-b-0 border-gray-200 gap-3 transition-all duration-200 ease-in-out accordion-btn"
                                    data-target="#accordion-color-body-{{ $module_name }}">
                                    <input type="checkbox" data-route="" class="chkAll form-checkbox scale-110 "
                                        data-target="#accordion-color-body-{{ $module_name }}" />
                                    <span class="ml-2 text-sm font-medium ">{{ $module_name }}</span>
                                    <i class="fa-solid fa-angle-down transition-transform duration-200"></i>
                                </button>
                            </h2>
                            <div id="accordion-color-body-{{ $module_name }}" class="hidden accordion-content">
                                <div class="grid grid-cols-3 gap-3 p-5 bg-white">
                                    @foreach ($forms as $form_name => $permissions)
                                        <div class="border border-gray-300 rounded-xl p-1 permission-group">
                                            <div class="mb-2 bg-gray-100 p-2 py-2 rounded-lg">
                                                <label class="items-center">
                                                    <input type="checkbox"
                                                        class="chkAll form-checkbox scale-110 !bg-white form-checkbox"
                                                        data-route="{{ $permissions[0]['route'] }}" />
                                                    <span
                                                        class="ml-2 text-sm font-medium text-gray-900">{{ $form_name }}</span>
                                                </label>
                                            </div>
                                            <div class="max-h-32 overflow-y-auto p-1 pl-5">
                                                @foreach ($permissions as $permissionData)
                                                    <div class="flex items-center mb-1">
                                                        <input id="chk{{ $permissionData['control_access_id'] }}"
                                                            data-route="{{ $permissionData['route'] }}"
                                                            class="form-checkbox child-checkbox" type="checkbox"
                                                            name="permission[{{ $permissionData['route'] }}][{{ $permissionData['permission_id'] }}]"
                                                            value="1" <?php echo $permissionData['selected'] ? 'checked' : ''; ?> />
                                                        <label for="chk{{ $permissionData['control_access_id'] }}"
                                                            class="ml-2 block text-sm text-gray-900">{{ $permissionData['permission_name'] }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex gap-2 w-fit ml-auto sticky bottom-0 py-3">
                    <a href='{{ route('admin.permissions.index') }}' type="button" class="btn-default">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Back
                    </a>
                    <button type="submit" class="btn-primary">
                        Submit <i class="fa-solid fa-arrow-right ml-2"></i>
                    </button>
                </div>
        </form>
    </div>
@endsection

@section('pagelevelscript')
    <script type="text/javascript">
        $(document).ready(function() {

            $(".chkAll").on("change", function() {
                let isChecked = $(this).is(":checked");
                $(this).closest(".permission-group").find("input[type=checkbox]").prop("checked",
                    isChecked);
            }).on("click", function(e) {
                e.stopPropagation();

            })

            $(".child-checkbox").on("change", function() {
                let parentGroup = $(this).closest(".permission-group");
                let allChecked = parentGroup.find(".child-checkbox").length === parentGroup.find(
                    ".child-checkbox:checked").length;
                parentGroup.find(".chkAll").first().prop("checked", allChecked);
            });


            let rules = {
                name: {
                    required: true,
                    minlength: 5,
                    maxlength: 100
                }
            };
            $("#form").validate({
                rules: rules,
                messages: {
                    name: {
                        required: "Permission Name is required",
                    },
                    "permission[]": {
                        required: "Select at least one Permission",

                    }
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
