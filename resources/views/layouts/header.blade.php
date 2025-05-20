@php  $permission = auth()->user()->permission_id;  @endphp
{{-- 
@foreach (session('all_permissions') as $key => $value)
    @php  echo $value;  @endphp
@endforeach
@php  echo exit;  @endphp --}}

<nav
    class="fixed top-0 left-0 right-0 bg-white backdrop-blur-md border-b border-gray-300 h-16 flex items-center justify-between px-4 z-20">
    <div class="flex items-center">
        <button id="toggleSidebar" class="w-4 mr-4 cursor-pointer"><i
                class="text-lg text-gray-600 fa-solid fa-bars"></i></button>
        <h1 class="text-md font-medium text-black flex items-center gap-3 "> <img class="rounded-md w-10 h-10"
                src="{{ asset('assets/images/navbar-logo.png') }}" alt=""> Learning Management System</h1>
    </div>
    <div class="flex items-center space-x-4">
        <button id="changePermission" class="btn-default">
            {{ session('permission_name') ?? 'Permissions' }}
        </button>
        <button id="profileMenu"><i
                class="pointer-events-none text-gray-600 text-lg fa-solid fa-user-circle"></i></button>
        {{-- <button id="notificationsMenu"><i
                class="pointer-events-none text-gray-600 text-lg fa-solid fa-bell"></i></button> --}}

        <!-- Trigger Button -->
        <div class="relative">
            <button id="toggleBtn" class="relative bg-white p-2 px-3 rounded-full  hover:bg-gray-100 focus:outline-none">
                <!-- Bell Icon -->
                <i class="pointer-events-none text-gray-600 text-lg fa-solid fa-bell"></i>
                <!-- Notification Dot -->
                <span class="absolute top-1 right-1 inline-block w-2 h-2 bg-red-500 rounded-full"></span>
            </button>

            <!-- Dropdown Popup -->
            <div id="dropdown"
                class="hidden absolute right-0 mt-2 w-80 bg-white shadow-lg rounded-lg overflow-hidden z-50">
                <div class="p-4 border-b border-gray-200">
                    <h4 class=" font-semibold text-gray-700">Recent Notifications</h4>
                </div>
                <ul class="max-h-60 overflow-y-auto divide-y divide-gray-200">
                    <li class="p-4 hover:bg-gray-50 cursor-pointer">
                        <p class="text-sm text-gray-800">🔔 New comment on your post</p>
                        <span class="text-xs text-gray-500">2 minutes ago</span>
                    </li>
                    <li class="p-4 hover:bg-gray-50 cursor-pointer">
                        <p class="text-sm text-gray-800">📦 Your order has been shipped</p>
                        <span class="text-xs text-gray-500">1 hour ago</span>
                    </li>
                    <li class="p-4 hover:bg-gray-50 cursor-pointer">
                        <p class="text-sm text-gray-800">👤 New follower: Jane Doe</p>
                        <span class="text-xs text-gray-500">Yesterday</span>
                    </li>
                </ul>
                <div class="p-2 text-center border-t border-gray-200">
                    <a href="{{ url('admin/notifications') }}" class="text-sm text-blue-600 hover:underline">View All
                        Notifications</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    $(document).ready(() => {
        const toggleBtn = document.getElementById('toggleBtn');
        const dropdown = document.getElementById('dropdown');

        toggleBtn.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
        });

        // Optional: Close when clicking outside
        document.addEventListener('click', (e) => {
            if (!toggleBtn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
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
                    label: '<i class="fa-solid fa-envelope mr-1"></i> Notification Center',
                    link: "{{ url('admin/notifications') }}",
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





    $(function() {
        $('.dtpDate').daterangepicker({
            opens: 'left',
            singleDatePicker: true,
            autoApply: true,
            locale: {
                format: 'DD-MM-YYYY'
            },
            // autoUpdateInput: false
            // showDropdowns: true,
            // minYear: 1901,
            // maxYear: parseInt(moment().format('YYYY'),10)
        }, function(start, end, label) {
            var years = moment().diff(start, 'years');

        });
    });
</script>
