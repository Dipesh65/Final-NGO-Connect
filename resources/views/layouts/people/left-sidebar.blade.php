<div class="w-72 h-screen overflow-y-auto scrollbar-hide bg-white fixed left-0 p-4">
    <!-- User Profile -->
    <div class="p-6 border-b border-gray-100">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gray-300 rounded-full overflow-hidden">
                @if (auth()->user()->profile_photo)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile"
                        class="w-full h-full object-cover">
                @else
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                @endif
            </div>
            <div>
                <h3 class="font-semibold text-gray-900">{{ auth()->user()->name }}</h3>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="p-4">
        <ul class="space-y-2">
            <!-- Search NGOs -->
            <li>
                <a href="{{ route('people.ngo.search') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span class="font-medium">Search NGOs</span>
                </a>
            </li>

            <!-- Events -->
            <li>
                <a href="{{ route('people.volunteer.opportunities') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="font-medium">Events</span>
                </a>
            </li>

            <!-- Donations -->
            <li>
                <a href="{{ route('people.donations') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <span class="font-medium">Donations</span>
                </a>
            </li>

            <!-- Your NGOs -->
            <li>
                <a href="{{ route('people.profile') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <span class="font-medium">Your NGOs</span>
                </a>
            </li>

            <!-- Notifications -->
            <li>
                <a href="{{ route('people.notifications') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <span class="font-medium">Notifications</span>
                    @if (auth()->user()->unreadNotifications->count() > 0)
                        <span class="ml-2 bg-red-500 text-white text-xs rounded-full px-2 py-1">{{ auth()->user()->unreadNotifications->count() }}</span>
                    @endif
                </a>
            </li>
        </ul>
    </nav>

    <!-- Your NGOs Section -->
    @if (auth()->user()->favoriteNgos()->count() > 0)
        <div class="p-4 mt-6 border-t border-gray-100">
            <h4 class="text-sm font-semibold text-gray-900 mb-3">Your NGOs</h4>
            <div class="space-y-2">
                @forelse (auth()->user()->favoriteNgos()->get() as $ngo)
                    <a href="{{ route('people.ngo.profile', $ngo->id) }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200">
                        <div class="w-8 h-8 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center">
                            @if ($ngo->logo)
                                <img src="{{ asset('storage/' . $ngo->logo) }}" alt="{{ $ngo->name }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            @endif
                        </div>
                        <span class="text-sm font-medium">{{ $ngo->user->name }}</span>
                    </a>
                @empty
                    <p class="text-gray-600 text-sm px-3">No NGOs yet.</p>
                @endforelse
            </div>
        </div>
    @endif

    <!-- Quick Stats Section -->
    <div class="p-4 mt-6 border-t border-gray-100">
        <h4 class="text-sm font-semibold text-gray-900 mb-3">Quick Stats</h4>
        <div class="space-y-2">
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">NGOs Followed</span>
                <span class="text-sm font-medium text-red-600">{{ auth()->user()->followedNgos()->count() }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Events Joined</span>
                <span class="text-sm font-medium text-red-600">5</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Total Donations</span>
                <span class="text-sm font-medium text-red-600">$250</span>
            </div>
        </div>
    </div>
</div>
