@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-900">NGO Details</h1>
            </div>

            {{-- NGO Profile Card --}}
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex items-start gap-6">
                    {{-- Logo --}}
                    <div class="flex-shrink-0">
                        @if ($ngo->ngo && $ngo->ngo->logo)
                            <img src="{{ Storage::url($ngo->ngo->logo) }}" alt="{{ $ngo->name }}"
                                class="w-24 h-24 rounded-full object-cover border-4 border-gray-100">
                        @else
                            <div
                                class="w-24 h-24 rounded-full bg-red-100 flex items-center justify-center border-4 border-gray-100">
                                <span class="text-3xl font-bold text-red-500">{{ substr($ngo->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>

                    {{-- NGO Info --}}
                    <div class="flex-1">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-2">{{ $ngo->name }}</h2>
                        <div class="flex items-center gap-4 flex-wrap">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-700">
                                {{ $ngo->ngo->category }}
                            </span>
                            @if ($ngo->ngo->suspended)
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-700">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.293 7.293a1 1 0 011.414 0L10 7.586l.293-.293a1 1 0 111.414 1.414L11.414 9l.293.293a1 1 0 01-1.414 1.414L10 10.414l-.293.293a1 1 0 01-1.414-1.414L8.586 9l-.293-.293a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Suspended
                                </span>
                            @elseif ($ngo->ngo->verified)
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Verified
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-700">
                                    Pending Verification
                                </span>
                            @endif
                        </div>
                        <p class="text-gray-600 mt-2 inline">Contact Person: <span class="font-medium text-gray-900">
                                {{ $ngo->owner->name ?? 'N/A' }} ({{ $ngo->ngo->contact_position ?? 'N/A' }})
                            </span>
                            <span class="px-1">||</span>
                            <span class="font-medium text-gray-900">{{ $ngo->owner->phone ?? 'N/A' }}</span>
                        </p>
                    </div>

                    {{-- Back Button --}}
                    <div class="flex-shrink-0">
                        <a href="{{ route('admin.ngos') }}"
                            class="inline-flex items-center px-4 py-2 border border-red-300 rounded-lg text-sm font-medium text-red-700 bg-white hover:bg-red-50 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back
                        </a>
                    </div>
                </div>
            </div>

            {{-- Registration Information --}}
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex items-center mb-4">
                    <div class="w-1 h-6 bg-red-500 rounded-full mr-3"></div>
                    <h3 class="text-lg font-semibold text-gray-900">Registration Information</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm text-gray-500 mb-1">Registration Number</label>
                        <p class="text-base font-medium text-gray-900">{{ $ngo->ngo->registration_number ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-500 mb-1">Registration Date</label>
                        <p class="text-base font-medium text-gray-900">
                            {{ $ngo->ngo->registration_date ? \Carbon\Carbon::parse($ngo->ngo->registration_date)->format('d-m-Y') : 'N/A' }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-500 mb-1">Registration District</label>
                        <p class="text-base font-medium text-gray-900">{{ $ngo->ngo->registration_district ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-500 mb-1">PAN Number</label>
                        <p class="text-base font-medium text-gray-900">{{ $ngo->ngo->pan_number ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-500 mb-1">Last Renewal Date</label>
                        <p class="text-base font-medium text-gray-900">
                            {{ $ngo->ngo->last_renewal_date ? \Carbon\Carbon::parse($ngo->ngo->last_renewal_date)->format('d-m-Y') : 'N/A' }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-500 mb-1">Category</label>
                        <p class="text-base font-medium text-gray-900">{{ $ngo->ngo->category ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            {{-- Contact Information --}}
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex items-center mb-4">
                    <div class="w-1 h-6 bg-red-500 rounded-full mr-3"></div>
                    <h3 class="text-lg font-semibold text-gray-900">Contact Information</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm text-gray-500 mb-1">Phone Number</label>
                        <p class="text-base font-medium text-gray-900">{{ $ngo->ngo->phone ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-500 mb-1">Email Address</label>
                        <p class="text-base font-medium text-gray-900">{{ $ngo->email ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-500 mb-1">Website</label>
                        <p class="text-base font-medium text-gray-900">{{ $ngo->ngo->website ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            {{-- Address --}}
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex items-center mb-4">
                    <div class="w-1 h-6 bg-red-500 rounded-full mr-3"></div>
                    <h3 class="text-lg font-semibold text-gray-900">Address</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-3">
                        <label class="block text-sm text-gray-500 mb-1">Full Address</label>
                        <p class="text-base font-medium text-gray-900">{{ $ngo->ngo->address ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            {{-- Mission & Description --}}
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex items-center mb-4">
                    <div class="w-1 h-6 bg-red-500 rounded-full mr-3"></div>
                    <h3 class="text-lg font-semibold text-gray-900">Mission & Description</h3>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm text-gray-500 mb-2">Mission</label>
                        <p class="text-base text-gray-900 leading-relaxed">
                            {{ $ngo->ngo->mission ?? 'No mission statement provided.' }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-500 mb-2">Description</label>
                        <p class="text-base text-gray-900 leading-relaxed">
                            {{ $ngo->ngo->description ?? 'No description provided.' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Sub Categories --}}
            @if ($ngo->ngo->subcategory)
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <div class="flex items-center mb-4">
                        <div class="w-1 h-6 bg-red-500 rounded-full mr-3"></div>
                        <h3 class="text-lg font-semibold text-gray-900">Sub Categories</h3>
                    </div>

                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach (explode(',', $ngo->ngo->subcategory) as $sub)
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-700">
                                {{ trim($sub) }}
                            </span>
                        @endforeach
                    </div>

                    {{-- Suspend NGO Button (only for verified NGOs) --}}
                    <div class="flex justify-end">
                        <form action="{{ route('admin.ngos.suspend', $ngo->id) }}" method="POST">
                            @csrf
                            @if ($ngo->ngo->suspended)
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors font-medium">
                                    <i class="fas fa-play-circle mr-2"></i>
                                    Unsuspend NGO
                                </button>
                            @else
                                <button type="button" onclick="openSuspendModal()"
                                    class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors font-medium">
                                    <i class="fas fa-pause-circle mr-2"></i>
                                    Suspend NGO
                                </button>
                            @endif
                        </form>
                    </div>

                </div>
            @endif

            {{-- Photo Gallery --}}
            @if ($ngo->ngo->photos && count($ngo->ngo->photos) > 0)
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Photo Gallery</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($ngo->ngo->photos as $photo)
                            <div class="relative group overflow-hidden rounded-lg border border-gray-200">
                                <img src="{{ asset('storage/' . $photo->path) }}" alt="NGO Photo"
                                    class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Verification Documents --}}
            @if ($ngo->ngo->documents && count($ngo->ngo->documents) > 0)
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Verification Documents</h3>
                    </div>

                    <div class="space-y-3">
                        @foreach ($ngo->ngo->documents as $document)
                            <div
                                class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $document->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $document->type }}</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $document->path) }}" download
                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Download
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Admin Actions (Verify / Reject) --}}
            @if (!$ngo->verified)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-1 h-6 bg-red-500 rounded-full mr-3"></div>
                        <h2 class="text-xl font-bold text-gray-900">Admin Actions</h2>
                    </div>
                    <div class="flex space-x-4">
                        <form action="{{ route('admin.ngos.verify', $ngo->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <button type="submit"
                                class="flex items-center justify-center px-4 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors font-medium">
                                <i class="fas fa-check-circle mr-2"></i>
                                Verify NGO
                            </button>
                        </form>

                        <button type="button" onclick="openRejectModal()"
                            class="flex items-center justify-center px-4 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors font-medium">
                            <i class="fas fa-times-circle mr-2"></i>
                            Reject NGO
                        </button>
                    </div>
                </div>
            @endif

        </div>
    </div>

    {{-- Rejection Modal --}}
    <div id="rejectModal" class="hidden fixed inset-0 bg-black/10 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <div class="bg-red-500 px-6 py-4 rounded-t-lg">
                <h2 class="text-xl font-bold text-white">Reject NGO Application</h2>
            </div>
            <form id="rejectForm" action="{{ route('admin.ngos.reject', $ngo->id) }}" method="POST">
                @csrf
                @method('POST')
                <div class="p-6">
                    <div class="mb-4">
                        <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">
                            Reason for Rejection <span class="text-red-500">*</span>
                        </label>
                        <textarea name="rejection_reason" id="rejection_reason" rows="5"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent resize-none"
                            placeholder="Please provide a detailed reason for rejecting this NGO application..." required></textarea>
                        @error('rejection_reason')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <p class="text-xs text-gray-500 mb-4">
                        This reason will be sent to the NGO via email.
                    </p>
                </div>
                <div class="bg-gray-50 px-6 py-4 rounded-b-lg flex justify-end space-x-3">
                    <button type="button" onclick="closeRejectModal()"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-medium">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors font-medium">
                        Confirm Rejection
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Suspend Modal --}}
    <div id="suspendModal" class="hidden fixed inset-0 bg-black/10 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <div class="bg-orange-500 px-6 py-4 rounded-t-lg">
                <h2 class="text-xl font-bold text-white">Suspend NGO</h2>
            </div>
            <form id="suspendForm" action="{{ route('admin.ngos.suspend', $ngo->id) }}" method="POST">
                @csrf
                @method('POST')
                <div class="p-6">
                    <div class="mb-4">
                        <label for="suspension_reason" class="block text-sm font-medium text-gray-700 mb-2">
                            Reason for Suspension <span class="text-red-500">*</span>
                        </label>
                        <textarea name="suspension_reason" id="suspension_reason" rows="5"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent resize-none"
                            placeholder="Please provide a detailed reason for suspending this NGO..." required></textarea>
                        @error('suspension_reason')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <p class="text-xs text-gray-500 mb-4">
                        This reason will be sent to the NGO via email.
                    </p>
                </div>
                <div class="bg-gray-50 px-6 py-4 rounded-b-lg flex justify-end space-x-3">
                    <button type="button" onclick="closeSuspendModal()"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-medium">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors font-medium">
                        Confirm Suspension
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        /* ---------- Reject Modal ---------- */
        function openRejectModal() {
            $('#rejectModal').removeClass('hidden');
        }

        function closeRejectModal() {
            $('#rejectModal').addClass('hidden');
            $('#rejectForm')[0].reset();
        }

        /* ---------- Suspend Modal ---------- */
        function openSuspendModal() {
            $('#suspendModal').removeClass('hidden');
        }

        function closeSuspendModal() {
            $('#suspendModal').addClass('hidden');
            $('#suspendForm')[0].reset();
        }

        /* Close any modal when clicking outside */
        $('#rejectModal, #suspendModal').on('click', function(e) {
            if (e.target === this) {
                $(this).addClass('hidden');
                $(this).find('form')[0].reset();
            }
        });

        /* ---------- AJAX Reject ---------- */
        $('#rejectForm').on('submit', function(e) {
            e.preventDefault();
            const reason = $('#rejection_reason').val().trim();
            if (!reason) {
                alert('Please provide a reason for rejection.');
                return;
            }

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function() {
                    alert('NGO application rejected successfully!');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error rejecting NGO.');
                    console.error(xhr);
                }
            });
        });

        /* ---------- AJAX Suspend ---------- */
        $('#suspendForm').on('submit', function(e) {
            e.preventDefault();
            const reason = $('#suspension_reason').val().trim();
            if (!reason) {
                alert('Please provide a reason for suspension.');
                return;
            }

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function() {
                    alert('NGO suspended successfully!');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error suspending NGO.');
                    console.error(xhr);
                }
            });
        });
    </script>
@endpush
