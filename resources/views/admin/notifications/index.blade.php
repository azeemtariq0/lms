@extends('layouts.app')


@section('content')
    @include('layouts.additionalscripts.adddatatable')

    <style>
        #notificationLimit+.dropdown-menu {
            width: auto !important;
            left: 0 !important;
            right: auto !important;
            white-space: nowrap
        }

        .notification-item.unread {
            background-color: #f8fafc;
        }

        .notification-list {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 #f1f1f1;
        }

        .notification-list::-webkit-scrollbar {
            width: 6px;
        }

        .notification-list::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .notification-list::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 6px;
        }
    </style>

    <div class="w-full bg-white rounded-lg border border-gray-200">

        <div class="flex justify-between items-center p-4 border-b border-gray-200">

            <div class="flex gap-3 items-center">
                <div>
                    <input type="checkbox" name="" class="form-checkbox" id="">
                </div>
                <button id="notificationLimit" class="bg-gray-50 px-3 py-1.5 rounded-md text-xs text-gray-600 font-medium">50
                    Entries</button>
                <div class="flex items-center gap-2">
                    <button><i
                            class="fas fa-angle-left cursor-pointer text-sm text-gray-600 hover:bg-gray-200 py-1.5 px-2 bg-gray-50 rounded-md"></i></button>
                    <button><i
                            class="fas fa-angle-right cursor-pointer text-sm text-gray-600 hover:bg-gray-200 py-1.5 px-2 bg-gray-50 rounded-md"></i></button>
                    <div class="text-sm text-gray-600 font-medium">
                        1 - 50 of 2,130
                    </div>
                </div>
            </div>
            <div class="flex space-x-2">
                <button id="markAllRead" class="text-gray-500 hover:text-gray-700 text-sm font-medium cursor-pointer">Mark
                    all
                    as
                    read</button>
                <button class="text-sm text-gray-500 hover:text-gray-700"><i class="fas fa-envelope-open"></i></button>
            </div>
        </div>

        <div class="flex border-b border-gray-200">
            <button class="filter-tab active px-4 py-2 text-sm font-medium text-[#3b82f6]">All</button>
            <button class="filter-tab px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">Read</button>
            <button class="filter-tab px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">Unread</button>
        </div>

        <!-- Notification List -->
        <div class="notification-list divide-y divide-gray-200 max-h-[500px] overflow-y-auto">
            <!-- Unread Alert Notification -->
            <div class="notification-item unread p-4 hover:bg-gray-50 flex items-start">
             <div class="pr-2.5">
                    <input type="checkbox" name="" class="form-checkbox" id="">
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-medium text-gray-900">System Alert</h4>
                    <p class="text-sm text-gray-500 mt-1">Server CPU usage exceeded 90% threshold at 10:42 AM. Please check
                        your server resources.</p>
                    <span class="text-xs text-gray-400 mt-1 block">2 minutes ago</span>
                </div>

            </div>

            <!-- Read Message Notification -->
            <div class="notification-item p-4 hover:bg-gray-50 flex items-start">
              <div class="pr-2.5">
                    <input type="checkbox" name="" class="form-checkbox" id="">
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-medium text-gray-900">New Message</h4>
                    <p class="text-sm text-gray-500 mt-1">You have a new message from Sarah Johnson regarding the Q2 report.
                        Please review when you get a chance.</p>
                    <span class="text-xs text-gray-400 mt-1 block">1 hour ago</span>
                </div>

            </div>

            <!-- Unread Warning Notification -->
            <div class="notification-item unread p-4 hover:bg-gray-50 flex items-start">
              <div class="pr-2.5">
                    <input type="checkbox" name="" class="form-checkbox" id="">
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-medium text-gray-900">Security Warning</h4>
                    <p class="text-sm text-gray-500 mt-1">Unusual login attempt detected from a new device in New York. Was
                        this you?</p>
                    <span class="text-xs text-gray-400 mt-1 block">3 hours ago</span>
                </div>

            </div>

            <!-- System Update Notification -->
            <div class="notification-item p-4 hover:bg-gray-50 flex items-start">
                <div class="pr-2.5">
                    <input type="checkbox" name="" class="form-checkbox" id="">
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-medium text-gray-900">System Update</h4>
                    <p class="text-sm text-gray-500 mt-1">Version 2.3.5 has been successfully installed. Check the changelog
                        for new features.</p>
                    <span class="text-xs text-gray-400 mt-1 block">5 hours ago</span>
                </div>

            </div>

            <!-- New User Notification -->
            <div class="notification-item unread p-4 hover:bg-gray-50 flex items-start">
                <div class="pr-2.5">
                    <input type="checkbox" name="" class="form-checkbox" id="">
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-medium text-gray-900">New Team Member</h4>
                    <p class="text-sm text-gray-500 mt-1">Michael Scott has joined your team. Assign them projects and
                        welcome them!</p>
                    <span class="text-xs text-gray-400 mt-1 block">1 day ago</span>
                </div>

            </div>
        </div>


    </div>







    {{-- <div id="content" class="padding-20">


        <div class="col-md-3 pb-3" style="padding: 10px;">
            <select class="form-control">
                <option>Mark as Read</option>
                <option>Mark Unread</option>
            </select>
        </div>

        <div class=" mt-2">
            <table id="dataTable"
                class="shadow-sm bg-white rounded-lg overflow-hidden  w-full border-collapse bg-gray-50 !border-gray-300 text-sm">
                <thead>
                    <tr>
                        <th class=" w-1/3">
                            <div class="form-label p-2 !m-0">Heading Text</div>
                        </th>
                        <th class=" w-1/3">
                            <div class="form-label p-2 !m-0">Message</div>
                        </th>
                        <th class=" w-1/3">
                            <div class="form-label p-2 !m-0">Status</div>
                        </th>
                        <th class="!w-40">
                            <div class="form-label p-2 !m-0 text-center"> Action</div>
                        </th>

                    </tr>
                </thead>
                <tbody>
                </tbody>

            </table>

        </div>
        <!-- /panel content -->

    </div> --}}
@endsection

@section('pagelevelscript')
    {{-- <script type="text/javascript">
        const csrfToken = "{{ csrf_token() }}";
        const changeStatusRoute = "{{ route('admin.notifications.changeStatus') }}";
        $(function() {

            $("#dataTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.notifications.index') }}"
                },
                columns: [{
                    data: 'heading_text',
                    name: 'heading_text'
                }, {
                    data: 'message',
                    name: 'message'
                }, {
                    data: 'is_read',
                    name: 'is_read'
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }, ],
                ...dataTableStyling
            });

        });


        // ✅ Change Status Event
        $(document).on('click', '.change-status', function() {
            let id = $(this).data('id');
            let status = $(this).data('status') ? 0 : 1;
            $.ajax({
                url: changeStatusRoute,
                type: 'POST',
                data: {
                    _token: csrfToken,
                    id: id,
                    status: status
                },
                success: function() {
                    $("#dataTable").DataTable().ajax.reload();
                }
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            new Dropdown('#notificationLimit', {
                options: [{
                        label: '50 Entries',
                        link: '#',
                    },
                    {
                        label: '100 Entries',
                        link: '#',
                    }
                ]
            });

            // Update unread count
            function updateUnreadCount() {
                const count = $('.notification-item.unread').length;
                $('#unreadCount').text(count);
                if (count === 0) {
                    $('#unreadCount').addClass('hidden');
                } else {
                    $('#unreadCount').removeClass('hidden');
                }
            }

            // Mark all as read
            $('#markAllRead').click(function() {
                $('.notification-item').removeClass('unread');
                updateUnreadCount();
                showToast('All notifications marked as read');
            });

            // Dismiss individual notification
            $('.notification-dismiss').click(function() {
                $(this).closest('.notification-item').fadeOut(300, function() {
                    $(this).remove();
                    updateUnreadCount();

                    // Check if no notifications left
                    if ($('.notification-item').length === 0) {
                        $('.notification-list').append(
                            '<div class="p-8 text-center text-gray-500">No notifications to display</div>'
                        );
                    }
                });
                showToast('Notification dismissed');
            });

            // Filter tabs functionality
            $('.filter-tab').click(function() {
                $('.filter-tab').removeClass('active text-blue-600 border-blue-600');
                $(this).addClass('active text-blue-600 border-blue-600');

                const filter = $(this).text().trim();
                showToast(`Showing ${filter} notifications`);

                // In a real app, you would filter notifications here
                // This is just a placeholder for the functionality
            });

            // Show toast notification
            function showToast(message) {
                $('#toastMessage').text(message);
                $('#toast').removeClass('hidden').addClass('flex');

                setTimeout(() => {
                    $('#toast').addClass('hidden').removeClass('flex');
                }, 3000);
            }

            // Close toast manually
            $('#toastClose').click(function() {
                $('#toast').addClass('hidden').removeClass('flex');
            });

            // Initialize unread count
            updateUnreadCount();
        });
    </script>
@endsection
