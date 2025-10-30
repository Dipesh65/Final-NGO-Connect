@extends('layouts.app')

@section('content')
    {{-- {{ dd($ngo) }} --}}

    {{-- <div class="min-h-screen bg-gray-50"> --}}
        <!-- Header with Logo -->
        <div class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 py-8">
                <div class="flex items-center gap-6">
                    @if($ngo->ngo && $ngo->ngo->logo)
                        <img src="{{ Storage::url($ngo->ngo->logo) }}" alt="{{ $ngo->name }}"
                            class="w-24 h-24 rounded-full object-cover border-4 border-gray-100">
                    @else
                        <div
                            class="w-24 h-24 rounded-full bg-red-100 flex items-center justify-center border-4 border-gray-100">
                            <span class="text-3xl font-bold text-red-500">{{ substr($ngo->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $ngo->name }}</h1>
                        <p class="text-gray-600 mt-1">{{ $ngo->ngo->category }} @if($ngo->ngo->sub_category) •
                        {{ $ngo->ngo->sub_category }} @endif</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left Sidebar - Organization Details & Charts -->
                <div class="lg:col-span-1">
                    <!-- Basic Details Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Organization Details</h2>

                        <div class="space-y-4">
                            <!-- Description -->
                            <div>
                                <p class="text-sm font-semibold text-gray-700">Description</p>
                                {{-- <p class="text-gray-600 text-sm mt-1">{{ $ngo->ngo->description }}</p> --}}
                                <p class="text-sm text-gray-900">
                                {{ $ngo->ngo->description ?? 'No description provided.' }}
                            </p>
                            </div>

                            <!-- Mission -->
                            
                                <div class="pt-4 border-t border-gray-200">
                                    <p class="text-sm font-semibold text-gray-700">Mission</p>
                                    <p class="text-sm text-gray-900">
                                {{ $ngo->ngo->mission ?? 'Misson not provided.' }}
                            </p>
                                </div>
                            
                            <!-- Contact Information -->
                            <div class="pt-4 border-t border-gray-200">
                                <p class="text-sm font-semibold text-gray-700 mb-3">Contact Information</p>
                                <div class="space-y-2 text-sm">
                                        <div class="flex items-start gap-2">
                                            <span class="text-gray-600 font-medium">Phone:</span>
                                            <span class="text-sm text-gray-900">
                                {{ $ngo->ngo->phone ?? 'NA.' }}
                            </p>
                                        </div>
                                    
                                        <div class="flex items-start gap-2">
                                            <span class="text-gray-600 font-medium">Address:</span>
                                            <span class="text-sm text-gray-900">
                                {{ $ngo->ngo->address ?? 'NA' }}
                            </p>
                                        </div>
                                    
                                </div>
                            </div>

                            <!-- Registration Details -->
                            <div class="pt-4 border-t border-gray-200">
                                <p class="text-sm font-semibold text-gray-700 mb-3">Registration Details</p>
                                <div class="space-y-2 text-sm">
                                        <div class="flex items-start gap-2">
                                            <span class="text-gray-600 font-medium">Reg. Number:</span>
                                            <span class="text-gray-600">{{ $ngo->ngo->registration_number}} </span>
                                        </div>
                                        <div class="flex items-start gap-2">
                                            <span class="text-gray-600 font-medium">District:</span>
                                            <span class="text-gray-600">{{ $ngo->ngo->registration_district }}</span>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="space-y-4">
                        <!-- Total Events -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Total Events</p>
                                    <p class="text-3xl font-bold text-gray-900 mt-2" id="total-events">
                                        {{ $stats['total_events'] ?? 0 }}</p>
                                </div>
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Total Donations -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Total Donations</p>
                                    <p class="text-3xl font-bold text-gray-900 mt-2" id="total-donations">
                                        ${{ number_format($stats['total_donations'] ?? 0, 2) }}</p>
                                </div>
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Total Followers -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Total Followers</p>
                                    <p class="text-3xl font-bold text-gray-900 mt-2" id="total-followers">
                                        {{ $stats['total_followers'] ?? 0 }}</p>
                                </div>
                                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20h12a6 6 0 00-6-6 6 6 0 00-6 6z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Section -->
                    <div class="bg-white rounded-lg shadow-md p-6 mt-4">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Activity Overview</h3>
                        <canvas id="activityChart" class="w-full"></canvas>
                    </div>
                </div>

                <!-- Right Sidebar - Posts Feed -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md">
                        <div class="border-b border-gray-200 px-6 py-4">
                            <h2 class="text-xl font-bold text-gray-900">Posts</h2>
                        </div>

                        <!-- Posts Container -->
                        <div id="posts-container" class="divide-y divide-gray-200">
                            <!-- Posts will be loaded here via AJAX -->
                            <div class="p-6 text-center text-gray-500">
                                <p>Loading posts...</p>
                            </div>
                        </div>

                        <!-- Load More Button -->
                        <div class="border-t border-gray-200 px-6 py-4 text-center" id="load-more-container"
                            style="display: none;">
                            <button id="load-more-btn"
                                class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                Load More Posts
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--
    </div> --}}

    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            const ngoId = {{ $ngo->id }};
            let currentPage = 1;
            const postsPerPage = 5;

            // Load initial posts
            loadPosts(1);

            // Load More Posts
            $(document).on('click', '#load-more-btn', function () {
                currentPage++;
                loadPosts(currentPage);
            });

            function loadPosts(page) {
                $.ajax({
                    url: `/api/ngo/${ngoId}/posts`,
                    type: 'GET',
                    data: {
                        page: page,
                        per_page: postsPerPage
                    },
                    success: function (response) {
                        if (page === 1) {
                            $('#posts-container').empty();
                        }

                        if (response.data.length > 0) {
                            response.data.forEach(function (post) {
                                const postHTML = `
                                <div class="p-6 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-start gap-4">
                                        <img src="${post.ngo_logo || '/placeholder.svg?height=48&width=48'}" alt="${post.ngo_name}" class="w-12 h-12 rounded-full object-cover">
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="font-semibold text-gray-900">${post.ngo_name}</p>
                                                    <p class="text-sm text-gray-500">${formatDate(post.created_at)}</p>
                                                </div>
                                                <button class="text-gray-400 hover:text-gray-600">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <p class="text-gray-700 mt-3">${post.content}</p>
                                            ${post.image ? `<img src="${post.image}" alt="Post image" class="w-full rounded-lg mt-4 object-cover max-h-96">` : ''}
                                            <div class="flex items-center gap-6 mt-4 text-gray-500 text-sm">
                                                <button class="flex items-center gap-2 hover:text-red-600 transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                    </svg>
                                                    <span>${post.likes_count || 0}</span>
                                                </button>
                                                <button class="flex items-center gap-2 hover:text-blue-600 transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                    <span>${post.comments_count || 0}</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                                $('#posts-container').append(postHTML);
                            });

                            // Show/hide load more button
                            if (response.data.length < postsPerPage) {
                                $('#load-more-container').hide();
                            } else {
                                $('#load-more-container').show();
                            }
                        } else if (page === 1) {
                            $('#posts-container').html(`
                            <div class="p-6 text-center text-gray-500">
                                <p>No posts yet</p>
                            </div>
                        `);
                        }
                    },
                    error: function () {
                        if (currentPage === 1) {
                            $('#posts-container').html(`
                            <div class="p-6 text-center text-red-500">
                                <p>Error loading posts</p>
                            </div>
                        `);
                        }
                    }
                });
            }

            // Initialize Activity Chart
            const ctx = document.getElementById('activityChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                        datasets: [
                            {
                                label: 'Events',
                                data: [{{ $stats['events_by_week'] ?? '0,0,0,0' }}],
                                borderColor: '#3B82F6',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                tension: 0.4,
                                fill: true
                            },
                            {
                                label: 'Donations',
                                data: [{{ $stats['donations_by_week'] ?? '0,0,0,0' }}],
                                borderColor: '#10B981',
                                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                tension: 0.4,
                                fill: true
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            // Helper function to format date
            function formatDate(dateString) {
                const date = new Date(dateString);
                const now = new Date();
                const diffTime = Math.abs(now - date);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                if (diffDays === 0) return 'Today';
                if (diffDays === 1) return 'Yesterday';
                if (diffDays < 7) return `${diffDays} days ago`;
                if (diffDays < 30) return `${Math.floor(diffDays / 7)} weeks ago`;
                return date.toLocaleDateString();
            }
        });
    </script>
@endsection