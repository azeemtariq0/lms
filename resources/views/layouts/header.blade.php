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
                class="text-lg text-gray-600 fa-duotone fa-bars"></i></button>
        <h1 class="text-md font-medium text-black">LMS / Management System</h1>
    </div>
    <div class="flex items-center space-x-4">
        <button id="changePermission">
            <div class="btn-default">{{ session('permission_name') ?? 'Permissions' }}</div>
        </button>
        <button id="profileMenu"><i class="text-gray-600 text-lg fa-duotone fa-user-circle"></i></button>
        <button id="notificationsMenu"><i class="text-gray-600 text-lg fa-duotone fa-bell"></i></button>

    </div>
</nav>

<script>
    $(document).ready(() => {

        // Profile Menu Dropdown init
        new Dropdown({
            triggerElement: '#profileMenu',
            items: [{
                    title: " {{ Auth::user()->name }}",
                }, {
                    title: 'Profile',
                    link: '#',
                    icon: 'fa-duotone fa-user'
                },
                {
                    title: 'Settings',
                    link: '#',
                    icon: 'fa-duotone fa-gear'
                }, ,
                {
                    title: 'Logout',
                    link: "{{ route('logout') }}",
                    icon: 'fa-duotone fa-right-from-bracket'
                },
            ]
        });
        const all_permissions = {!! json_encode(session('all_permissions')) !!};

        new Dropdown({
            triggerElement: '#changePermission',
            items: all_permissions.map(permission => {
                return {
                    title: permission.name,
                    link: 'javascript:void(0)',
                    onClick: `changePermission(${permission.id})`
                };
            })
        });

        // Notifications Menu Dropdown init
        new Dropdown({
            triggerElement: '#notificationsMenu',
            items: [{
                    title: 'New Message',
                    link: '#',
                    icon: 'fa-duotone fa-envelope'
                },
                {
                    title: 'System Update',
                    link: '#',
                    icon: 'fa-duotone fa-gear'
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
