@foreach ($posts as $post)
    <article id="post-{{ $post->id }}" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <!-- Post Header -->
        <div class="p-6 pb-4">
            <div class="flex items-start justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-hands-helping text-red-500"></i>
                    </div>
                    <div>
                        <div class="flex items-center">
                            <a href="{{route('common.ngo.profile', $post->user->id)}}" class="font-bold text-gray-900">
                                @isset($post->user->ngo->ngo_name)
                                    {{ $post->user->ngo->ngo_name ? $post->user->ngo->ngo_name : $post->user->name}}
                                @endisset

                            </a>
                            <span class="ml-1 mr-1 text-gray-500">•</span>
                            <!-- Follow button-->
                            <button id="follow-btn-{{ $post->id }}" data-ngo-id="{{ $post->user->id }}"
                                class="follow-button text-red-500 font-medium text-md hover:underline cursor-pointer">
                                @if($post->is_following) Following @else Follow @endif
                            </button>
                        </div>
                        <div class="flex items-center space-x-2 text-sm text-gray-500">
                            <span>{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <!-- Dropdown menu for post options -->
                    <div class="relative">
                        <button class="post-options-btn p-2 hover:bg-gray-100 rounded-full transition-colors"
                            data-post-id="{{ $post->id }}">
                            <i class="fas fa-ellipsis-h text-gray-400 cursor-pointer"></i>
                        </button>
                        <!-- Dropdown Menu -->
                        <div class="post-options-dropdown hidden absolute right-0 top-full mt-1 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-10"
                            data-post-id="{{ $post->id }}">
                            <div class="py-1 w-full">
                                <button
                                    class="report-post-btn w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2 whitespace-nowrap"
                                    data-post-id="{{ $post->id }}">
                                    <i class="fas fa-flag text-red-500"></i>
                                    <span>Report Post</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Post Content -->
        <div class="px-6 pb-4">
            <p class="text-gray-900 leading-relaxed">{{ $post->description }}</p>
        </div>

        <!-- Post Images -->
        @if (count($post->medias) > 0)
            <div class="px-6 pb-4">
                @if (count($post->medias) == 1)
                    <div class="rounded-lg overflow-hidden border border-gray-200">
                        <img src="{{ asset($post->medias[0]->media_path_name) }}" alt="Post Image"
                            class="w-full h-auto max-h-96 object-cover cursor-pointer image-modal-trigger"
                            data-post-id="{{ $post->id }}" data-image-index="0">
                    </div>
                @elseif (count($post->medias) == 2)
                    <div class="grid grid-cols-2 gap-2 rounded-lg overflow-hidden">
                        @foreach ($post->medias as $index => $media)
                            <img src="{{ asset($media->media_path_name) }}" alt="Post Image"
                                class="w-full h-48 object-cover cursor-pointer image-modal-trigger" data-post-id="{{ $post->id }}"
                                data-image-index="{{ $index }}">
                        @endforeach
                    </div>
                @else
                    <div class="grid grid-cols-2 gap-2 rounded-lg overflow-hidden">
                        <img src="{{ asset($post->medias[0]->media_path_name) }}" alt="Post Image"
                            class="w-full h-64 object-cover cursor-pointer image-modal-trigger" data-post-id="{{ $post->id }}"
                            data-image-index="0">
                        <div class="grid grid-rows-2 gap-2">
                            <img src="{{ asset($post->medias[1]->media_path_name) }}" alt="Post Image"
                                class="w-full h-31 object-cover cursor-pointer image-modal-trigger" data-post-id="{{ $post->id }}"
                                data-image-index="1">
                            <div class="relative">
                                <img src="{{ asset($post->medias[2]->media_path_name) }}" alt="Post Image"
                                    class="w-full h-31 object-cover cursor-pointer image-modal-trigger"
                                    data-post-id="{{ $post->id }}" data-image-index="2">
                                @if (count($post->medias) > 3)
                                    <div class="absolute inset-0 bg-black/60 flex items-center justify-center cursor-pointer image-modal-trigger"
                                        data-post-id="{{ $post->id }}" data-image-index="2">
                                        <span class="text-white text-xl font-bold">+{{ count($post->medias) - 3 }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <!-- Engagement Section -->
        <div class="px-6 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-2">
                    <div class="flex -space-x-1">
                        <div class="w-6 h-6 bg-red-500 rounded-full border-2 border-white flex items-center justify-center">
                            <i class="fas fa-heart text-white text-xs"></i>
                        </div>
                    </div>
                    <span id="likes-{{ $post->id }}" class="text-sm text-gray-600 font-medium">
                        {{ count($post->likes) }} {{ count($post->likes) == 1 ? 'Like' : 'Likes' }}
                    </span>
                </div>
                <div class="text-sm text-gray-600">
                    <span id="comment-{{ $post->id }}">{{ count($post->comments) }}
                        {{count($post->comments) == 1 ? 'Comment' : 'Comments'}}</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center space-x-1">
                <button data="{{ $post->id }}"
                    class="like-button flex-1 flex items-center justify-center space-x-2 py-3 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer @if($post->is_liked) bg-red-50 text-red-500 @endif">
                    <i class="fa-heart @if($post->is_liked) fas text-red-500 @else far text-gray-600 @endif"></i>
                    <span class="font-medium @if($post->is_liked) text-red-500 @else text-gray-600 @endif">
                        @if($post->is_liked) Liked @else Like @endif
                    </span>
                </button>

                <button data="{{ $post->id }}"
                    class="comment-button flex-1 flex items-center justify-center space-x-2 py-3 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                    <i class="far fa-comment text-gray-600"></i>
                    <span class="text-gray-600 font-medium">Comment</span>
                </button>
            </div>
        </div>
    </article>
@endforeach