@extends('layouts.app')

@section('content')
    <div>
        <!-- Header Section -->
        <div class="max-w-7xl mx-auto px-4 px-8 flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-900">Events</h1>
                <p class="text-gray-500 mt-2">Explore and manage all your organization's events</p>
            </div>
            <a href="{{ route('ngo.events.create') }}" class="inline-flex items-center px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600">
                <span class="iconify inline-block mr-2" data-icon="fluent:add-circle-20-filled" data-width="20" data-height="20"></span>
                Create Event
            </a>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 px-8">
            @if ($events->isEmpty())
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-md p-12 text-center">
                    <span class="iconify text-6xl text-gray-300 mx-auto block mb-6" data-icon="fluent:calendar-20-filled" data-width="64" data-height="64"></span>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No Events Found</h3>
                    <p class="text-gray-500 mb-6">Create your first event to get started with organizing activities for your community.</p>
                    <a href="{{ route('ngo.events.create') }}" class="inline-flex items-center px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-700 transition-colors">
                        <span class="iconify inline-block mr-2" data-icon="fluent:add-circle-20-filled" data-width="18" data-height="18"></span>
                        Create First Event
                    </a>
                </div>
            @else
                <!-- Events Grid -->
                <div class="grid grid-cols-1 grid-cols-2 gap-6">
                    @foreach ($events as $event)
                        <div class="bg-white rounded-sm overflow-hidden shadow-lg hover:shadow-2xl h-full flex flex-col">
                            <!-- Image Container -->
                            <div class="relative w-full h-36 overflow-hidden">
                                @if ($event->cover_image_path_name)
                                    <img src="{{ asset('storage/' . $event->cover_image_path_name) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-red-500 to-red-500">
                                        <span class="iconify text-white" data-icon="fluent:calendar-20-filled" data-width="64" data-height="64"></span>
                                    </div>
                                @endif
                                <!-- Event Type Badge -->
                                <div class="absolute top-4 right-4">
                                    <span class="inline-block px-3 py-1 bg-white rounded-full text-xs font-semibold {{ $event->type == 0 ? 'text-blue-700 bg-blue-100' : 'text-gray-700 bg-gray-100' }}">
                                        {{ $event->type == 0 ? 'Online' : 'Offline' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content Section -->
                            <div class="p-5 flex-1 flex flex-col">
                                <!-- Title -->
                                <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-red-500 transition-colors">{{ $event->title }}</h3>

                                <!-- Date and Location Info -->
                                <div class="space-y-2 mb-3">
                                    <!-- Start Date -->
                                    <div class="flex items-start space-x-2">
                                        <div>
                                            <span class="text-sm font-semibold text-gray-500">Start Date: </span>
                                            <span class="text-sm font-medium text-gray-900">{{ $event->start_date->format('M d, Y') }}</span> 
                                            <span class="text-sm text-gray-500"> ({{ $event->start_date->format('h:i A') }}) </span>
                                        </div>
                                    </div>

                                    <!-- End Date -->
                                    <div class="flex items-start space-x-2">
                                        <div>
                                            <span class="text-sm font-semibold text-gray-500">End Date:</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $event->end_date->format('M d, Y') }}</span>
                                            <span class="text-sm text-gray-500">( {{ $event->end_date->format('h:i A') }} )</span>
                                        </div>
                                    </div>

                                    <!-- Location -->
                                    <div class="flex items-start space-x-2">
                                        <div>
                                            <span class="text-sm font-semibold text-gray-500 ">Location: </span>
                                            <span class="text-sm font-medium text-gray-900">{{ $event->location }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- View More Button -->
                                <a href="{{ route('ngo.event.details', $event->id) }}" class="w-full mt-3 inline-flex items-center justify-center px-4 py-2.5 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-700 transition-colors duration-200 shadow-md hover:shadow-lg text-sm">
                                    View Details
                                    <span class="iconify inline-block ml-2" data-icon="fluent:arrow-right-20-filled" data-width="16" data-height="16"></span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

            @endif
        </div>
    </div>

    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
@endsection
