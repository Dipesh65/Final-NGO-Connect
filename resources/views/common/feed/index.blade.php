@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Main Content -->
        <main class="w-full">
            <!-- Posts Feed -->
            <div class="space-y-6">
                @foreach ($posts as $post)
                    <article id="post-{{ $post->id }}"
                        class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <!-- Post Header -->
                        <div class="p-6 pb-4">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-hands-helping text-red-500"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900">{{ $post->user->name }}</h3>
                                        <div class="flex items-center space-x-2 text-sm text-gray-500">
                                            <span>{{ $post->created_at->diffForHumans() }}</span>
                                            <span>•</span>
                                            <i class="fas fa-globe-americas"></i>
                                            <span>Public</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <button class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                                        <i class="fas fa-ellipsis-h text-gray-400"></i>
                                    </button>
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
                                                class="w-full h-48 object-cover cursor-pointer image-modal-trigger"
                                                data-post-id="{{ $post->id }}" data-image-index="{{ $index }}">
                                        @endforeach
                                    </div>
                                @else
                                    <div class="grid grid-cols-2 gap-2 rounded-lg overflow-hidden">
                                        <img src="{{ asset($post->medias[0]->media_path_name) }}" alt="Post Image"
                                            class="w-full h-64 object-cover cursor-pointer image-modal-trigger"
                                            data-post-id="{{ $post->id }}" data-image-index="0">
                                        <div class="grid grid-rows-2 gap-2">
                                            <img src="{{ asset($post->medias[1]->media_path_name) }}" alt="Post Image"
                                                class="w-full h-31 object-cover cursor-pointer image-modal-trigger"
                                                data-post-id="{{ $post->id }}" data-image-index="1">
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
                                        <div
                                            class="w-6 h-6 bg-red-500 rounded-full border-2 border-white flex items-center justify-center">
                                            <i class="fas fa-heart text-white text-xs"></i>
                                        </div>
                                    </div>
                                    <span id="likes-{{ $post->id }}" class="text-sm text-gray-600 font-medium">
                                        {{ count($post->likes) }} {{ count($post->likes) == 1 ? 'Like' : 'Likes' }}
                                    </span>
                                </div>
                                <div class="text-sm text-gray-600">
                                    <span id="comment-{{ $post->id }}">{{ count($post->comments) }}</span> comments
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center space-x-1">
                                <button data="{{ $post->id }}"
                                    class="like-button flex-1 flex items-center justify-center space-x-2 py-3 rounded-lg hover:bg-gray-100 transition-colors">
                                    <i class="far fa-heart text-gray-600"></i>
                                    <span class="text-gray-600 font-medium">Like</span>
                                </button>
                                <button data="{{ $post->id }}"
                                    class="comment-button flex-1 flex items-center justify-center space-x-2 py-3 rounded-lg hover:bg-gray-100 transition-colors">
                                    <i class="far fa-comment text-gray-600"></i>
                                    <span class="text-gray-600 font-medium">Comment</span>
                                </button>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </main>
    </div>
@endsection

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center">
    <div class="relative max-w-7xl max-h-full w-full h-full flex items-center justify-center p-4">
        <!-- Close button -->
        <button id="closeModal" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
            <i class="fas fa-times text-2xl"></i>
        </button>
        
        <!-- Previous button -->
        <button id="prevImage" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 z-10 hidden">
            <i class="fas fa-chevron-left text-3xl"></i>
        </button>
        
        <!-- Next button -->
        <button id="nextImage" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 z-10 hidden">
            <i class="fas fa-chevron-right text-3xl"></i>
        </button>
        
        <!-- Image container -->
        <div class="flex items-center justify-center w-full h-full">
            <img id="modalImage" src="/placeholder.svg" alt="" class="max-w-full max-h-full object-contain">
        </div>
        
        <!-- Image counter -->
        <div id="imageCounter" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-white bg-black bg-opacity-50 px-3 py-1 rounded-full hidden">
            <span id="currentImageIndex">1</span> / <span id="totalImages">1</span>
        </div>
    </div>
</div>

<!-- Comments Modal -->
<div id="commentsModal" class="fixed inset-0 bg-gray-900 bg-opacity-30 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[80vh] flex flex-col">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-4 border-b border-gray-200 flex-shrink-0">
            <h3 class="text-lg font-semibold text-gray-900">Comments</h3>
            <button id="closeCommentsModal" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                <i class="fas fa-times text-gray-400"></i>
            </button>
        </div>
        
        <!-- Comments List (Scrollable) -->
        <div id="commentsList" class="flex-1 overflow-y-auto p-4 space-y-3 max-h-96">
            <!-- Comments will be loaded here -->
        </div>
        
        <!-- Comment Input -->
        <div class="p-4 border-t border-gray-200 flex-shrink-0">
            <!-- Added reply indicator section -->
            <div id="replyIndicator" class="hidden mb-3 p-2 bg-blue-50 rounded-lg border border-blue-200">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-blue-700">
                        <i class="fas fa-reply text-blue-500 mr-1"></i>
                        Replying to <span id="replyToUser" class="font-medium"></span>
                    </span>
                    <button id="cancelReply" class="text-blue-500 hover:text-blue-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-user text-red-500 text-sm"></i>
                </div>
                <div class="flex-1 flex space-x-2">
                    <input type="text" id="modalCommentInput" placeholder="Write a comment..." 
                           class="flex-1 bg-gray-100 border-0 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 focus:bg-white">
                    <button id="modalSubmitComment" class="bg-red-500 text-white px-4 py-2 rounded-full font-medium hover:bg-red-600 transition-colors">
                        Post
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const csrfToken = "{{ csrf_token() }}";
        let currentPostId = null;
        let currentPostImages = [];
        let currentImageIndex = 0;
        // Added variables to track reply state
        let replyToCommentId = null;
        let replyToUserName = null;

        const postsComments = {
            @foreach ($posts as $post)
                {{ $post->id }}: [
                    @foreach ($post->comments as $comment)
                        {
                            id: {{ $comment->id }},
                            comment: @json($comment->comment),
                            user_name: @json($comment->user->name ?? 'Anonymous'),
                            created_at: @json($comment->created_at->diffForHumans()),
                            user_avatar: @json($comment->user->avatar ?? null),
                            parent_id: {{ $comment->parent_id ?? 'null' }},
                            replies_count: {{ $comment->replies ? $comment->replies->count() : 0 }}
                        }@if(!$loop->last),@endif
                    @endforeach
                ]@if(!$loop->last),@endif
            @endforeach
        };

        $(document).ready(function() {
            $('.like-button').on('click', function() {
                const postId = $(this).attr('data');
                
                $.ajax({
                    url: "{{ route('common.feed.like') }}",
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': csrfToken
                    },
                    data: JSON.stringify({
                        post_id: postId
                    }),
                    success: function(data) {
                        const $button = $(`[data="${postId}"].like-button`);
                        const $icon = $button.find('i');
                        const $span = $button.find('span');
                        const $likesCount = $(`#likes-${postId}`);

                        $icon.removeClass().addClass('fas fa-heart text-red-500');
                        $span.text('Liked').removeClass().addClass('text-red-500 font-medium');
                        
                        const currentCount = parseInt($likesCount.text());
                        const newCount = currentCount + 1;
                        $likesCount.text(newCount + (newCount === 1 ? ' like' : ' likes'));
                    },
                    error: function() {
                        const $button = $(`[data="${postId}"].like-button`);
                        const $icon = $button.find('i');
                        const $span = $button.find('span');
                        const $likesCount = $(`#likes-${postId}`);

                        $icon.removeClass().addClass('far fa-heart text-gray-600');
                        $span.text('Like').removeClass().addClass('text-gray-600 font-medium');
                        
                        const currentCount = parseInt($likesCount.text());
                        const newCount = currentCount - 1;
                        $likesCount.text(newCount + (newCount === 1 ? ' like' : ' likes'));
                    }
                });
            });

            $('.comment-button').on('click', function() {
                currentPostId = $(this).attr('data');
                loadComments(currentPostId);
                openCommentsModal();
            });

            function loadComments(postId) {
                const comments = postsComments[postId] || [];
                displayComments(comments);
            }

            function displayComments(comments) {
                const $commentsList = $('#commentsList');
                $commentsList.empty();
                
                if (comments.length === 0) {
                    $commentsList.html('<p class="text-gray-500 text-center py-8">No comments yet. Be the first to comment!</p>');
                    return;
                }

                const mainComments = comments.filter(comment => !comment.parent_id);
                const replies = comments.filter(comment => comment.parent_id);
                
                mainComments.forEach(comment => {
                    const commentElement = createCommentElement(comment);
                    $commentsList.append(commentElement);
                    
                    const commentReplies = replies.filter(reply => reply.parent_id === comment.id);
                    if (commentReplies.length > 0) {
                        const repliesContainer = $(`<div class="replies-container hidden" data-comment-id="${comment.id}"></div>`);
                        commentReplies.forEach(reply => {
                            const replyElement = createReplyElement(reply);
                            repliesContainer.append(replyElement);
                        });
                        $commentsList.append(repliesContainer);
                    }
                });
            }

            function createCommentElement(comment) {
                const avatarHtml = comment.user_avatar 
                    ? `<img src="${comment.user_avatar}" alt="${comment.user_name}" class="w-8 h-8 rounded-full object-cover">`
                    : `<div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                         <i class="fas fa-user text-red-500 text-sm"></i>
                       </div>`;
                
                const replyCountHtml = comment.replies_count > 1 
                    ? `<button class="view-replies-btn text-sm text-gray-600 hover:text-gray-800 font-medium" data-comment-id="${comment.id}">
                         <i class="fas fa-chevron-down mr-1"></i>View all ${comment.replies_count} replies
                       </button>`
                    : '';
                
                return $(`
                    <div class="flex space-x-3 mb-4">
                        ${avatarHtml}
                        <div class="flex-1">
                            <div class="bg-gray-100 rounded-lg px-3 py-2">
                                <p class="font-medium text-sm text-gray-900">${comment.user_name}</p>
                                <p class="text-gray-800">${comment.comment}</p>
                            </div>
                            <div class="flex items-center space-x-4 mt-1 text-xs text-gray-500">
                                <span>${comment.created_at}</span>
                                <button class="reply-btn hover:text-gray-700" data-comment-id="${comment.id}" data-user-name="${comment.user_name}">Reply</button>
                            </div>
                            ${replyCountHtml}
                        </div>
                    </div>
                `);
            }

            function createReplyElement(reply) {
                const avatarHtml = reply.user_avatar 
                    ? `<img src="${reply.user_avatar}" alt="${reply.user_name}" class="w-7 h-7 rounded-full object-cover">`
                    : `<div class="w-7 h-7 bg-gray-200 rounded-full flex items-center justify-center flex-shrink-0">
                         <i class="fas fa-user text-gray-500 text-xs"></i>
                       </div>`;
                
                return $(`
                    <div class="flex space-x-3 ml-11 mb-3">
                        ${avatarHtml}
                        <div class="flex-1">
                            <div class="bg-gray-50 rounded-lg px-3 py-2 border border-gray-200">
                                <p class="font-medium text-sm text-gray-900">${reply.user_name}</p>
                                <p class="text-gray-700 text-sm">${reply.comment}</p>
                            </div>
                            <div class="flex items-center space-x-4 mt-1 text-xs text-gray-500">
                                <span>${reply.created_at}</span>
                                <button class="reply-btn hover:text-gray-700" data-comment-id="${reply.parent_id}" data-user-name="${reply.user_name}">Reply</button>
                            </div>
                        </div>
                    </div>
                `);
            }

            function openCommentsModal() {
                $('#commentsModal').removeClass('hidden');
                $('body').css('overflow', 'hidden');
                $('#modalCommentInput').focus();
            }

            function closeCommentsModalFunc() {
                $('#commentsModal').addClass('hidden');
                $('body').css('overflow', 'auto');
                $('#modalCommentInput').val('');
                // Reset reply state when closing modal
                cancelReply();
            }

            function submitComment() {
                const comment = $('#modalCommentInput').val().trim();
                if (!comment || !currentPostId) return;

                console.log('[v0] Submitting comment:', {
                    comment: comment,
                    post_id: currentPostId,
                    parent_id: replyToCommentId,
                    csrf_token: csrfToken
                });

                // Include parent_id in the request data
                const requestData = {
                    comment: comment,
                    post_id: currentPostId
                };
                
                if (replyToCommentId) {
                    requestData.parent_id = replyToCommentId;
                }

                console.log('[v0] Request data:', requestData);

                $.ajax({
                    url: "{{ route('common.feed.comment') }}",
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: JSON.stringify(requestData),
                    success: function(data) {
                        console.log('[v0] Comment posted successfully:', data);
                        
                        // Updated comment display for replies
                        const displayComment = replyToCommentId ? `@${replyToUserName} ${comment}` : comment;
                        
                        const newCommentData = {
                            id: data.id || Date.now(),
                            comment: displayComment,
                            user_name: 'you',
                            created_at: 'Just now',
                            user_avatar: null,
                            parent_id: replyToCommentId,
                            replies_count: 0
                        };
                        
                        // Add to local comments data
                        if (!postsComments[currentPostId]) {
                            postsComments[currentPostId] = [];
                        }
                        postsComments[currentPostId].push(newCommentData);
                        
                        // Remove "no comments" message if it exists
                        $('#commentsList p.text-gray-500').remove();
                        
                        if (replyToCommentId) {
                            // This is a reply - create reply element and append after parent comment
                            const newReply = createReplyElement(newCommentData);
                            
                            // Find or create replies container for this parent comment
                            let repliesContainer = $(`.replies-container[data-comment-id="${replyToCommentId}"]`);
                            
                            if (repliesContainer.length === 0) {
                                // Create new replies container if it doesn't exist
                                const parentCommentElement = $(`.reply-btn[data-comment-id="${replyToCommentId}"]`).closest('.flex.space-x-3.mb-4');
                                repliesContainer = $(`<div class="replies-container hidden" data-comment-id="${replyToCommentId}"></div>`);
                                parentCommentElement.after(repliesContainer);
                            }
                            
                            repliesContainer.append(newReply);
                            
                            // Show replies container if it's hidden
                            if (repliesContainer.hasClass('hidden')) {
                                repliesContainer.removeClass('hidden');
                            }
                            
                            // Update parent comment's reply count and view replies button
                            const parentCommentElement = $(`.reply-btn[data-comment-id="${replyToCommentId}"]`).closest('.flex.space-x-3.mb-4');
                            const viewRepliesBtn = parentCommentElement.find('.view-replies-btn');
                            
                            if (viewRepliesBtn.length) {
                                const currentCount = parseInt(viewRepliesBtn.text().match(/\d+/)[0]);
                                const newCount = currentCount + 1;
                                viewRepliesBtn.html(`<i class="fas fa-chevron-up mr-1"></i>Hide ${newCount} replies`);
                            } else {
                                // Add view replies button if this is the second reply
                                const existingReplies = repliesContainer.children().length;
                                if (existingReplies >= 2) {
                                    const viewRepliesHtml = `<button class="view-replies-btn text-sm text-gray-600 hover:text-gray-800 font-medium" data-comment-id="${replyToCommentId}"><i class="fas fa-chevron-up mr-1"></i>Hide ${existingReplies} replies</button>`;
                                    parentCommentElement.find('.flex.items-center.space-x-4.mt-1').after(viewRepliesHtml);
                                }
                            }
                        } else {
                            // This is a regular comment
                            const newComment = createCommentElement(newCommentData);
                            $('#commentsList').append(newComment);
                        }
                        
                        // Scroll to bottom
                        const commentsList = document.getElementById('commentsList');
                        commentsList.scrollTop = commentsList.scrollHeight;
                        
                        // Update comment count in main feed
                        const $commentCount = $(`#comment-${currentPostId}`);
                        const currentCount = parseInt($commentCount.text());
                        $commentCount.text(currentCount + 1);
                        
                        // Clear input and reset reply state
                        $('#modalCommentInput').val('');
                        cancelReply();
                    },
                    error: function(xhr, status, error) {
                        console.log('[v0] AJAX Error Details:', {
                            status: xhr.status,
                            statusText: xhr.statusText,
                            responseText: xhr.responseText,
                            error: error
                        });
                        
                        alert('Failed to post comment. Check console for details.');
                    }
                });
            }

            $('#modalSubmitComment').on('click', function() {
                submitComment();
            });

            $('#modalCommentInput').on('keypress', function(e) {
                if (e.which === 13) { // Enter key
                    submitComment();
                }
            });

            // Added reply button click handler
            $(document).on('click', '.reply-btn', function() {
                const commentId = $(this).data('comment-id');
                const userName = $(this).data('user-name');
                
                replyToCommentId = commentId;
                replyToUserName = userName;
                
                // Show reply indicator
                $('#replyToUser').text(userName);
                $('#replyIndicator').removeClass('hidden');
                
                // Update placeholder text
                $('#modalCommentInput').attr('placeholder', `Reply to ${userName}...`).focus();
            });
            
            // Added cancel reply functionality
            $('#cancelReply').on('click', function() {
                cancelReply();
            });
            
            function cancelReply() {
                replyToCommentId = null;
                replyToUserName = null;
                $('#replyIndicator').addClass('hidden');
                $('#modalCommentInput').attr('placeholder', 'Write a comment...');
            }

            $('#closeCommentsModal').on('click', closeCommentsModalFunc);
            
            $('#commentsModal').on('click', function(e) {
                if (e.target === this) {
                    closeCommentsModalFunc();
                }
            });

            $(document).on('keydown', function(e) {
                if (e.which === 27 && !$('#commentsModal').hasClass('hidden')) { // Escape key
                    closeCommentsModalFunc();
                }
            });

            // Image modal functionality (keeping existing vanilla JS for now)
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const closeModal = document.getElementById('closeModal');
            const prevButton = document.getElementById('prevImage');
            const nextButton = document.getElementById('nextImage');
            const imageCounter = document.getElementById('imageCounter');
            const currentIndexSpan = document.getElementById('currentImageIndex');
            const totalImagesSpan = document.getElementById('totalImages');

            // Open modal when image is clicked
            document.querySelectorAll('.image-modal-trigger').forEach(trigger => {
                trigger.addEventListener('click', (e) => {
                    e.preventDefault();
                    const postId = trigger.getAttribute('data-post-id');
                    const imageIndex = parseInt(trigger.getAttribute('data-image-index'));
                    
                    // Get all images for this post
                    const postImages = document.querySelectorAll(`[data-post-id="${postId}"].image-modal-trigger`);
                    currentPostImages = Array.from(postImages).map(img => img.src);
                    currentImageIndex = imageIndex;
                    
                    openModal();
                });
            });

            function openModal() {
                modalImage.src = currentPostImages[currentImageIndex];
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                
                // Update navigation buttons
                updateNavigation();
                
                // Update counter
                if (currentPostImages.length > 1) {
                    currentIndexSpan.textContent = currentImageIndex + 1;
                    totalImagesSpan.textContent = currentPostImages.length;
                    imageCounter.classList.remove('hidden');
                } else {
                    imageCounter.classList.add('hidden');
                }
            }

            function closeModalFunc() {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            function updateNavigation() {
                if (currentPostImages.length > 1) {
                    prevButton.classList.remove('hidden');
                    nextButton.classList.remove('hidden');
                } else {
                    prevButton.classList.add('hidden');
                    nextButton.classList.add('hidden');
                }
            }

            function showPrevImage() {
                if (currentImageIndex > 0) {
                    currentImageIndex--;
                    modalImage.src = currentPostImages[currentImageIndex];
                    currentIndexSpan.textContent = currentImageIndex + 1;
                }
            }

            function showNextImage() {
                if (currentImageIndex < currentPostImages.length - 1) {
                    currentImageIndex++;
                    modalImage.src = currentPostImages[currentImageIndex];
                    currentIndexSpan.textContent = currentImageIndex + 1;
                }
            }

            // Event listeners
            closeModal.addEventListener('click', closeModalFunc);
            prevButton.addEventListener('click', showPrevImage);
            nextButton.addEventListener('click', showNextImage);

            // Close modal when clicking outside the image
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closeModalFunc();
                }
            });

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (!modal.classList.contains('hidden')) {
                    switch(e.key) {
                        case 'Escape':
                            closeModalFunc();
                            break;
                        case 'ArrowLeft':
                            showPrevImage();
                            break;
                        case 'ArrowRight':
                            showNextImage();
                            break;
                    }
                }
            });

            $(document).on('click', '.view-replies-btn', function() {
                const commentId = $(this).data('comment-id');
                const repliesContainer = $(`.replies-container[data-comment-id="${commentId}"]`);
                const icon = $(this).find('i');
                
                if (repliesContainer.hasClass('hidden')) {
                    // Show replies
                    repliesContainer.removeClass('hidden');
                    const replyCount = repliesContainer.children().length;
                    $(this).html(`<i class="fas fa-chevron-up mr-1"></i>Hide ${replyCount} ${replyCount === 1 ? 'reply' : 'replies'}`);
                } else {
                    // Hide replies
                    repliesContainer.addClass('hidden');
                    const replyCount = repliesContainer.children().length;
                    $(this).html(`<i class="fas fa-chevron-down mr-1"></i>View all ${replyCount} ${replyCount === 1 ? 'reply' : 'replies'}`);
                }
            });
        });
    </script>
@endpush