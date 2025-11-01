{{-- Old Code, New Code is right below it in this same file --}}
{{-- @extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-8">
                <a href="{{ route('ngo.events') }}" class="inline-flex items-center text-red-500 hover:text-red-700 font-semibold transition-colors">
                    <span class="iconify inline-block mr-2" data-icon="fluent:arrow-left-20-filled" data-width="20" data-height="20"></span>
                    Back to Events
                </a>
            </div>

            <!-- Main Event Card -->
            <div class="bg-white rounded-sm overflow-hidden shadow-xl">
                <!-- Image -->
                <div class="relative w-full h-96 overflow-hidden bg-gradient-to-br from-red-100 to-red-50">
                    @if ($event->cover_image_path_name)
                        <img src="{{ asset('storage/' . $event->cover_image_path_name) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-red-500 to-red-500">
                            <span class="iconify text-white" data-icon="fluent:calendar-20-filled" data-width="128" data-height="128"></span>
                        </div>
                    @endif
                    <!-- Event Type Badge -->
                    <div class="absolute top-6 right-6">
                        <span class="inline-block px-4 py-2 bg-white rounded-full text-sm font-bold {{ $event->type == 0 ? 'text-blue-700 bg-blue-100' : 'text-gray-700 bg-gray-100' }}">
                            {{ $event->type == 0 ? 'Online Event' : 'Offline Event' }}
                        </span>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-8">
                    <!-- Title -->
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $event->title }}</h1>
                    <p class="w-full text-lg text-gray-600 mb-8 whitespace-pre-wrap break-words">{{ $event->description }}</p>


                    <!-- Key Information Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8 pb-8 border-b border-gray-200">
                        <!-- Date and Time -->
                        <div class="space-y-6">
                            <div>
                                <div class="flex items-center space-x-3 mb-4">
                                    <h3 class="text-lg font-bold text-gray-900">Start Date & Time</h3>
                                </div>
                                <div class="p-4 rounded-lg border border-red-400">
                                    <p class="text-2xl font-bold text-gray-900">{{ $event->start_date->format('M d, Y') }}</p>
                                    <p class="text-lg text-red-500 font-semibold mt-1">{{ $event->start_date->format('h:i A') }}</p>
                                </div>
                            </div>

                            <div>
                                <div class="flex items-center space-x-3 mb-4">
                                    <h3 class="text-lg font-bold text-gray-900">End Date & Time</h3>
                                </div>
                                <div class="p-4 rounded-lg border border-red-400">
                                    <p class="text-2xl font-bold text-gray-900">{{ $event->end_date->format('M d, Y') }}</p>
                                    <p class="text-lg text-red-500 font-semibold mt-1">{{ $event->end_date->format('h:i A') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Location and Capacity -->
                        <div class="space-y-6">
                            <div>
                                <div class="flex items-center space-x-3 mb-4">
                                    <h3 class="text-lg font-bold text-gray-900">Location</h3>
                                </div>
                                <div class="p-4 rounded-lg border border-red-400">
                                    <p class="text-lg font-semibold text-gray-900">{{ $event->location }}</p>
                                </div>
                            </div>

                            <div>
                                <div class="flex items-center space-x-3 mb-4">
                                    <h3 class="text-lg font-bold text-gray-900">Volunteer Capacity</h3>
                                </div>
                                <div class="p-4 rounded-lg border border-red-400">
                                    <p class="text-2xl font-bold text-red-500">{{ $event->volunteers()->count() }} <span class="text-gray-600 text-lg">/ {{ $event->capacity }}</span></p>
                                    <div class="mt-3 w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-red-500 h-2 rounded-full transition-all duration-300" style="width: {{ $event->capacity != 0 ? ($event->volunteers()->count() / $event->capacity) * 100 : 0 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Details -->
                    <div class="space-y-6">
                        @if ($event->category)
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center">
                                    <span class="iconify mr-2 text-red-600" data-icon="fluent:tag-20-filled" data-width="20" data-height="20"></span>
                                    Category
                                </h3>
                                <p class="text-gray-700 ml-8 text-base">{{ $event->category }}</p>
                            </div>
                        @endif

                        
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center">
                                    <span class="iconify mr-2 text-red-600" data-icon="fluent:checkmark-circle-20-filled" data-width="20" data-height="20"></span>
                                    Requirements
                                </h3>
                                <p class="text-gray-700 ml-8 text-base whitespace-pre-line">{{ $event->requirements }}</p>
                            </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-5 pt-8 border-t border-gray-200 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('ngo.event.edit',$event->id)}}" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition-colors duration-200 shadow-md hover:shadow-lg">
                            <span class="iconify mr-2" data-icon="fluent:edit-20-filled" data-width="20" data-height="20"></span>
                            Edit Event
                        </a>
                        <button type="button" onclick="if(confirm('Are you sure you want to delete this event?')) { document.getElementById('deleteForm').submit(); }" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 shadow-md hover:shadow-lg">
                            <span class="iconify mr-2" data-icon="fluent:delete-20-filled" data-width="20" data-height="20"></span>
                            Delete Event
                        </button>
                        <a href="{{ route('ngo.events') }}" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition-colors duration-200 shadow-md hover:shadow-lg">
                            <span class="iconify mr-2" data-icon="fluent:arrow-left-20-filled" data-width="20" data-height="20"></span>
                            Back to List
                        </a>
                    </div>
                </div>
            </div>

            <!-- Delete Form -->
            <form id="deleteForm" action="{{ route('ngo.event.delete',$event->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>

    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
    
@endsection --}}



@extends('layouts.app')
@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <a href="{{ route('ngo.events') }}"
                    class="inline-flex items-center text-red-500 hover:text-red-700 font-semibold transition-colors">
                    <span class="iconify inline-block mr-2" data-icon="fluent:arrow-left-20-filled" data-width="20"
                        data-height="20"></span>
                    Back to Events
                </a>
            </div>
            <div class="bg-white rounded-sm overflow-hidden shadow-xl">
                <div class="relative w-full h-96 overflow-hidden bg-gradient-to-br from-red-100 to-red-50">
                    @if ($event->cover_image_path_name)
                        <img src="{{ asset('storage/' . $event->cover_image_path_name) }}" alt="{{ $event->title }}"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-red-500 to-red-500">
                            <span class="iconify text-white" data-icon="fluent:calendar-20-filled" data-width="128"
                                data-height="128"></span>
                        </div>
                    @endif
                    <div class="absolute top-6 right-6">
                        <span
                            class="inline-block px-4 py-2 bg-white rounded-full text-sm font-bold {{ $event->type == 0 ? 'text-blue-700 bg-blue-100' : 'text-gray-700 bg-gray-100' }}">
                            {{ $event->type == 0 ? 'Online Event' : 'Offline Event' }}
                        </span>
                    </div>
                    <div class="absolute top-6 left-6">
                        @php
                            $statusClass = '';
                            $statusText = strtoupper($event->status ?? 'UNKNOWN');

                            switch ($event->status ?? 'unknown') {
                                case 'upcoming':
                                    $statusClass = 'bg-blue-100 text-blue-800 border-blue-300';
                                    break;
                                case 'live':
                                    $statusClass = 'bg-green-100 text-green-800 border-green-300';
                                    break;
                                case 'completed':
                                    $statusClass = 'bg-gray-100 text-gray-800 border-gray-300';
                                    break;
                                default:
                                    $statusClass = 'bg-yellow-100 text-yellow-800 border-yellow-300';
                            }
                        @endphp

                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $statusClass }}">
                            {{ $statusText }}
                        </span>
                    </div>

                </div>
                <div class="p-8">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $event->title }}</h1>
                    <p class="w-full text-lg text-gray-600 mb-8 whitespace-pre-wrap break-words">{{ $event->description }}
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8 pb-8 border-b border-gray-200">
                        <div class="space-y-6">
                            <div>
                                <div class="flex items-center space-x-3 mb-4">
                                    <h3 class="text-lg font-bold text-gray-900">Start Date & Time</h3>
                                </div>
                                <div class="p-4 rounded-lg border border-red-400">
                                    <p class="text-2xl font-bold text-gray-900">{{ $event->start_date->format('M d, Y') }}
                                    </p>
                                    <p class="text-lg text-red-500 font-semibold mt-1">
                                        {{ $event->start_date->format('h:i A') }}</p>
                                </div>
                            </div>
                            <div>
                                <div class="flex items-center space-x-3 mb-4">
                                    <h3 class="text-lg font-bold text-gray-900">End Date & Time</h3>
                                </div>
                                <div class="p-4 rounded-lg border border-red-400">
                                    <p class="text-2xl font-bold text-gray-900">{{ $event->end_date->format('M d, Y') }}</p>
                                    <p class="text-lg text-red-500 font-semibold mt-1">
                                        {{ $event->end_date->format('h:i A') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-6">
                            <div>
                                <div class="flex items-center space-x-3 mb-4">
                                    <h3 class="text-lg font-bold text-gray-900">Location</h3>
                                </div>
                                <div class="p-4 rounded-lg border border-red-400">
                                    <p class="text-lg font-semibold text-gray-900">{{ $event->location }}</p>
                                </div>
                            </div>
                            <div>
                                <div class="flex items-center space-x-3 mb-4">
                                    <h3 class="text-lg font-bold text-gray-900">Volunteer Capacity</h3>
                                </div>
                                <div class="p-4 rounded-lg border border-red-400">
                                    <p class="text-2xl font-bold text-red-500">{{ $event->volunteers()->count() }} <span
                                            class="text-gray-600 text-lg">/ {{ $event->capacity }}</span></p>
                                    <div class="mt-3 w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-red-500 h-2 rounded-full transition-all duration-300"
                                            style="width: {{ $event->capacity != 0 ? ($event->volunteers()->count() / $event->capacity) * 100 : 0 }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-6">
                        @if ($event->category)
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center">
                                    <span class="iconify mr-2 text-red-600" data-icon="fluent:tag-20-filled" data-width="20"
                                        data-height="20"></span>
                                    Category
                                </h3>
                                <p class="text-gray-700 ml-8 text-base">{{ $event->category }}</p>
                            </div>
                        @endif

                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center">
                                <span class="iconify mr-2 text-red-600" data-icon="fluent:checkmark-circle-20-filled"
                                    data-width="20" data-height="20"></span>
                                Requirements
                            </h3>
                            <p class="text-gray-700 ml-8 text-base whitespace-pre-line">{{ $event->requirements }}</p>
                        </div>

                    </div>
                    <div class="mt-5 pt-8 border-t border-gray-200 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('ngo.event.edit', $event->id)}}"
                            class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition-colors duration-200 shadow-md hover:shadow-lg">
                            <span class="iconify mr-2" data-icon="fluent:edit-20-filled" data-width="20"
                                data-height="20"></span>
                            Edit Event
                        </a>
                        <button type="button"
                            onclick="if(confirm('Are you sure you want to delete this event?')) { document.getElementById('deleteForm').submit(); }"
                            class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 shadow-md hover:shadow-lg">
                            <span class="iconify mr-2" data-icon="fluent:delete-20-filled" data-width="20"
                                data-height="20"></span>
                            Delete Event
                        </button>
                        <a href="{{ route('ngo.events') }}"
                            class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition-colors duration-200 shadow-md hover:shadow-lg">
                            <span class="iconify mr-2" data-icon="fluent:arrow-left-20-filled" data-width="20"
                                data-height="20"></span>
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
            <form id="deleteForm" action="{{ route('ngo.event.delete', $event->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
@endsection
