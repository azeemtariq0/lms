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
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="form-label required">Name</label>
                    <div class="mt-1">
                        <input type="text" name="name" id="name" class="form-input"
                            value="{{ $permission->name ?? old('name') }}">
                    </div>
                </div>

                <div>
                    <div class="bg-white/80 rounded-lg px-3 py-3 mb-2">
                        <label class="form-label !mb-0 required">Permissions</label>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach ($permission->permission as $module_name => $forms)
                            <div class="col-span-3">
                                <strong class="block text-sm font-semibold text-gray-900">{{ $module_name }}</strong>
                            </div>
                            @foreach ($forms as $form_name => $permissions)
                                <div class="border border-gray-300 rounded-lg p-2">
                                    <div class="mb-2 bg-white/80 p-3 py-2 rounded-lg">
                                        <label class="items-center">
                                            <input type="checkbox" class="chkAll form-checkbox scale-110"
                                                data-route="{{ $permissions[0]['route'] }}" />
                                            <span class="ml-2 text-sm font-medium text-gray-900">{{ $form_name }}</span>
                                        </label>
                                    </div>
                                    <div class="max-h-32 overflow-y-auto p-1">
                                        @foreach ($permissions as $permissionData)
                                            <div class="flex items-center mb-1">
                                                <input id="chk{{ $permissionData['control_access_id'] }}"
                                                    data-route="{{ $permissionData['route'] }}" class="form-checkbox"
                                                    type="checkbox"
                                                    name="permission[{{ $permissionData['route'] }}][{{ $permissionData['permission_id'] }}]"
                                                    value="1" <?php echo $permissionData['selected'] ? 'checked' : ''; ?> />
                                                <label for="chk{{ $permissionData['control_access_id'] }}"
                                                    class="ml-2 block text-sm text-gray-900">{{ $permissionData['permission_name'] }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="flex gap-2 w-fit ml-auto sticky bottom-0 py-3">
                <a href='{{ route('admin.permissions.index') }}' type="button" class="btn-default">
                    <i class="fa-duotone fa-arrow-left mr-2"></i> Back
                </a>
                <button type="submit" class="btn-primary">
                    Submit <i class="fa-duotone fa-arrow-right ml-2"></i>
                </button>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        $('.chkAll').on('change', (e) => {
            let obj = e.currentTarget;
            let route = $(obj).data('route');
            let isChecked = $(obj).is(':checked');
            $(obj).closest('.border').find('input[type=checkbox]').prop('checked', isChecked);
        });
    </script>

    <script>
        $(document).ready(function() {

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
