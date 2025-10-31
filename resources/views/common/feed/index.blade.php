@extends('layouts.app')

@section('content')

    <!-- Create Post -->
    @if (auth()->user()->isNgo())
        <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
            <div class="flex justify-stretch items-center space-x-3 mb-4">
                <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                <form id="post" action="{{ route('common.post.create') }}" class="items-center flex flex-row justify-between"
                    method="POST">
                    @csrf
                </form>
                <input form="post" type="text" name="description" placeholder="What's on your mind, {{ auth()->user()->name }}?"
                    class="flex-1 bg-gray-100 rounded-full px-4 py-2 focus:outline-none hover:bg-gray-200 cursor-pointer">
                <button form="post" type="submit"
                    class="flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-gray-100">Create Post </button>
            </div>
            <div class="flex items-center justify-between pt-2 border-t border-gray-200">
                <div class="flex space-x-4">

                    <button class="flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-images text-green-500"></i>
                        <span class="text-gray-600 font-medium">Photo/video</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="min-h-screen bg-gray-50">
        <!-- Main Content -->
        <main class="w-full">
            <!-- Posts Feed -->
            <div class="space-y-6">
                @include('common.feed.partials.post')
            </div>
        </main>
    </div>
@endsection

@include('common.feed.partials.modal')