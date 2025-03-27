@php  $permission = auth()->user()->permission_id;  @endphp
{{-- 
@foreach (session('all_permissions') as $key => $value)
    @php  echo $value;  @endphp
@endforeach
@php  echo exit;  @endphp --}}

<nav
    class="fixed top-0 left-0 right-0 bg-white/60 backdrop-blur-md border-b border-gray-300 h-16 flex items-center justify-between px-4 z-20">
    <div class="flex items-center">
        <button id="toggleSidebar" class="w-4 mr-4 cursor-pointer"><i
                class="text-lg text-gray-600 fa-solid fa-bars"></i></button>
        <h1 class="text-md font-medium text-black">LMS / Management System</h1>
    </div>
    <div class="flex items-center space-x-4">
        <button id="changePermission" class="btn-default">
            {{ session('permission_name') ?? 'Permissions' }}
        </button>
        <button id="profileMenu"><i
                class="pointer-events-none text-gray-600 text-lg fa-solid fa-user-circle"></i></button>
        <button id="notificationsMenu"><i class="pointer-events-none text-gray-600 text-lg fa-solid fa-bell"></i></button>

    </div>
</nav>

<script>
    $(document).ready(() => {

        // Profile Menu Dropdown init

        new Dropdown("#profileMenu", {
            options: [{
                    label: "{{ Auth::user()->name }}",
                    className: "hover:bg-transparent !cursor-default",
                },
                {
                    label: " <i class='fa-solid fa-user mr-1' ></i> Profile",
                    link: "#",
                },
                {
                    label: " <i class='fa-solid fa-gear mr-1' ></i> Settings",
                    link: "#",
                },
                {
                    label: " <i class='fa-solid fa-right-from-bracket mr-1' ></i> Logout",
                    link: "{{ route('logout') }}",
                }
            ]
        });
        const all_permissions = {!! json_encode(session('all_permissions')) !!};

        new Dropdown("#changePermission", {
            options: all_permissions.map(permission => {
                return {
                    label: permission.name,
                    value: permission.id,

                }
            }),
            onChange: function(option) {
                changePermission(option.value);
            }
        });

        // Notifications Menu Dropdown init
        new Dropdown('#notificationsMenu', {
            options: [{
                    label: '<i class="fa-solid fa-envelope mr-1"></i> New Message',
                    link: '#',
                },
                {
                    label: '<i class="fa-solid fa-gear mr-1"></i> System Update',
                    link: '#',
                }
            ]
        });


    });

    function changePermission(permission) {
        $.ajax({
            url: "{{ url('admin/change-permission') }}",
            type: 'post',
            data: {
                'permission_id': permission,
                "_token": "{{ csrf_token() }}"
            },
            success: function() {
                location.reload();
            }
        });
    }
</script>
