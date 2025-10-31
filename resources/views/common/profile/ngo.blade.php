@extends('layouts.app')

@section('content')

    <!-- Header with Logo -->
    <div class="bg-white border-b border-red-300">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="flex items-center gap-6">
                @if($ngo->ngo && $ngo->ngo->logo)
                    <img src="{{ Storage::url($ngo->ngo->logo) }}" alt="{{ $ngo->name }}"
                        class="w-24 h-24 rounded-full object-cover border-4 border-gray-100">
                @else
                    <div class="w-24 h-24 rounded-full bg-red-100 flex items-center justify-center border-4 border-gray-100">
                        <span class="text-3xl font-bold text-red-500">{{ substr($ngo->name, 0, 1) }}</span>
                    </div>
                @endif
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $ngo->name }}</h1>
                    <p class="text-gray-600 mt-1"> <span class=" text-red-500">Category: </span> {{ $ngo->ngo->category }}
                    </p>

                    <p class="text-gray-600">
                        @if($ngo->ngo->subcategory) <span class=" text-red-500">Sub-Category: </span>
                        {{ $ngo->ngo->subcategory }} @endif
                    </p>
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
                            <p class="text-sm font-semibold text-red-500">Description</p>
                            <p class="text-sm text-gray-900">
                                {{ $ngo->ngo->description ?? 'No description provided.' }}
                            </p>
                        </div>

                        <!-- Mission -->
                        <div class="pt-4 border-t border-gray-200">
                            <p class="text-sm font-semibold text-red-500">Mission</p>
                            <p class="text-sm text-gray-900">
                                {{ $ngo->ngo->mission ?? 'Misson not provided.' }}
                            </p>
                        </div>

                        <!-- Contact Information -->
                        <div class="pt-4 border-t border-gray-200">
                            <p class="text-sm font-semibold text-red-500 mb-3">Contact Information</p>
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
                            <p class="text-sm font-semibold text-red-500 mb-3">Registration Details</p>
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
                                <p class="text-3xl font-bold text-gray-900 mt-2" id="total-events">{{ $eventsCount }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    {{ $followersCount ?? 0 }}
                                </p>
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
                {{-- <div class="bg-white rounded-lg shadow-md p-6 mt-4">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Activity Overview</h3>
                    <canvas id="activityChart" class="w-full"></canvas>
                </div> --}}
            </div>

            <!-- Posts Feed -->
            <div class="lg:col-span-2">
                <div>
                    <div class="bg-white rounded-lg shadow-md border-b border-gray-200 px-6 py-4 mb-5">
                        <h2 class="text-xl font-bold text-gray-900">Posts</h2>
                    </div>

                    <!-- Posts Container -->
                    <div id="posts-container" class="space-y-6">
                        @include('common.feed.partials.post', ['post' => $posts])
                    </div>
                    {{-- <div id="posts-container" class="divide-y divide-gray-200">
                        @include('common.feed.partials.post',['post' => $posts])
                    </div> --}}

                    <!-- Load More Button -->
                    {{-- <div class="border-t border-gray-200 px-6 py-4 text-center" id="load-more-container"
                        style="display: none;">
                        <button id="load-more-btn"
                            class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Load More Posts
                        </button>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
@endsection

@include('common.feed.partials.modal')