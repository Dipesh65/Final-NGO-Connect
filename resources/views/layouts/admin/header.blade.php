<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo Section -->
            <div class="flex items-center space-x-2">
                <div class="w-auto">
                    <img src="{{ url('logo-nobg.png') }}" alt="Logo" class="h-10">
                </div>
            </div>

            <!-- Center Navigation Menu -->
            <div class="lg:block flex-1 max-w-4xl mx-8">
                <div class="flex items-center justify-center space-x-1">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'text-red-500' : 'text-gray-600 hover:text-red-600' }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                        <span class="whitespace-nowrap">Dashboard</span>
                    </a>

                    <a href="{{ route('admin.ngos') }}"
                        class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.ngos') ? 'text-red-500' : 'text-gray-600 hover:text-red-600' }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                        <span class="whitespace-nowrap">NGO Management</span>
                    </a>

                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.user.*') ? 'text-red-500' : 'text-gray-600 hover:text-red-600' }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg>
                        <span class="whitespace-nowrap">User Management</span>
                    </a>

                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.reports') ? 'text-red-500' : 'text-gray-600 hover:text-red-600' }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span class="whitespace-nowrap">Reports</span>
                    </a>

                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.event.*') ? 'text-red-500' : 'text-gray-600 hover:text-red-600' }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span class="whitespace-nowrap">Events</span>
                    </a>

                    <a href="{{ route('admin.log') }}"
                        class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.log') ? 'text-red-500' : 'text-gray-600 hover:text-red-600' }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                        <span class="whitespace-nowrap">Logs</span>
                    </a>
                </div>
            </div>

            <div class="flex items-center space-x-2">
                <!-- Notification Button -->
                <div class="relative">
                    <button class="p-2 bg-gray-100 rounded-full hover:bg-gray-200 notification-btn">
                        <span class="iconify text-gray-700" data-icon="mdi:bell"></span>
                        @if (auth()->user()->unreadNotifications->count() > 0)
                            <span
                                class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ auth()->user()->unreadNotifications->count() }}</span>
                        @endif
                    </button>

                    <!-- Notification Dropdown -->
                    <div
                        class="notification-dropdown absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 hidden z-50">
                        <div class="p-4 border-b border-gray-200">
                            <h3 class="text-xl font-bold text-gray-900">Notifications</h3>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            @forelse (auth()->user()->unreadNotifications as $notification)
                                <div class="p-3 hover:text-red-500 cursor-pointer bg-blue-50">
                                    <div class="flex items-start space-x-3">
                                        <div
                                            class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                                            <span class="iconify text-gray-500" data-icon="mdi:bell"></span>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm text-gray-500">
                                                {{ $notification->data['message'] ?? 'Notification' }}
                                            </p>
                                            <p class="text-xs text-gray-400 mt-1">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="p-3 text-gray-600 text-sm">No new notifications.</p>
                            @endforelse
                        </div>
                        <div class="p-3 border-t border-gray-200">
                            <a href="{{ route(auth()->user()->isNgo() ? 'ngo.notifications' : 'people.notifications') }}"
                                class="w-full text-center text-blue-600 hover:text-red-500 py-2 rounded-lg block">
                                See all notifications
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Admin User Dropdown -->
                <div class="relative">
                    <button id="admin-dropdown-toggle"
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-red-500 hover:text-gray-600 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                        <svg id="dropdown-chevron" class="w-4 h-4 ml-2 transition-transform duration-200" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="admin-dropdown-menu"
                        class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                        <div class="py-1">
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-600 hover:text-red-500 hover:text-gray-600 transition-colors">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Settings
                            </a>
                            <button id="logout-btn"
                                class="w-full flex items-center px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 hover:text-gray-700 transition-colors">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                Logout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- jQuery Script for Dropdown Functionality -->
<script>
    $(document).ready(function () {
        // Toggle dropdown menu
        $('#admin-dropdown-toggle').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            const $menu = $('#admin-dropdown-menu');
            const $chevron = $('#dropdown-chevron');

            $menu.toggleClass('hidden');
            $chevron.toggleClass('rotate-180');
        });

        // Close dropdown when clicking outside
        $(document).on('click', function (e) {
            if (!$(e.target).closest('#admin-dropdown-toggle, #admin-dropdown-menu').length) {
                $('#admin-dropdown-menu').addClass('hidden');
                $('#dropdown-chevron').removeClass('rotate-180');
            }
        });

        // Handle logout with AJAX
        $('#logout-btn').on('click', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to logout?')) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route("logout") }}',
                    type: 'POST',
                    success: function (response) {
                        window.location.href = '{{ route("login") }}';
                    },
                    error: function (xhr, status, error) {
                        console.error('Logout failed:', error);
                        // Fallback to regular form submission
                        $('<form>', {
                            'method': 'POST',
                            'action': '{{ route("logout") }}'
                        }).append($('<input>', {
                            'type': 'hidden',
                            'name': '_token',
                            'value': '{{ csrf_token() }}'
                        })).appendTo('body').submit();
                    }
                });
            }
        });
    });
</script>
