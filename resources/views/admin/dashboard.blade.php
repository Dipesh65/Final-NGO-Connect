@extends('layouts.app')
@section('content')

<!-- Dashboard Cards Grid -->
<div class="grid grid-cols-3 gap-6">
    <!-- Total Registered NGOs -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-base font-medium text-gray-600">Total Registered NGOs</p>
                <p class="text-3xl font-bold text-gray-900" id="total-ngos">{{$ngoCount}}</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-building text-blue-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-base text-green-600 font-medium">
                <i class="fas fa-arrow-up"></i> +12% from last month
            </span>
        </div>
    </div>

    <!-- Total Users -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-base font-medium text-gray-600">Total Users</p>
                <p class="text-3xl font-bold text-gray-900" id="total-users">{{$userCount}}</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-users text-green-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-base text-green-600 font-medium">
                <i class="fas fa-arrow-up"></i> +8% from last month
            </span>
        </div>
    </div>

    <!-- Pending NGO Approvals -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-base font-medium text-gray-600">Pending NGO Approvals</p>
                <p class="text-3xl font-bold text-gray-900" id="pending-ngo-approvals">{{$pendingNgoApprovals}}</p>
            </div>
            <div class="bg-yellow-100 p-3 rounded-full">
                <i class="fas fa-clock text-yellow-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <button class="text-base text-red-600 font-medium hover:text-red-700">
                <i class="fas fa-eye"></i> Review Pending
            </button>
        </div>
    </div>

    <!-- Pending Event Approvals -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-base font-medium text-gray-600">Pending Event Approvals</p>
                <p class="text-3xl font-bold text-gray-900" id="pending-event-approvals">-</p>
            </div>
            <div class="bg-orange-100 p-3 rounded-full">
                <i class="fas fa-calendar-check text-orange-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <button class="text-base text-red-600 font-medium hover:text-red-700">
                <i class="fas fa-eye"></i> Review Pending
            </button>
        </div>
    </div>

    <!-- Reported Posts -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-base font-medium text-gray-600">Reported Posts</p>
                <p class="text-3xl font-bold text-gray-900" id="reported-posts">{{$reportedPosts}}</p>
            </div>
            <div class="bg-red-100 p-3 rounded-full">
                <i class="fas fa-flag text-red-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <button class="text-base text-red-600 font-medium hover:text-red-700">
                <i class="fas fa-exclamation-triangle"></i> Review Reports
            </button>
        </div>
    </div>

    <!-- Total Donations Raised -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-base font-medium text-gray-600">Donations Raised</p>
                <p class="text-3xl font-bold text-gray-900" id="total-donations">{{$totalDonations}}</p>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <i class="fas fa-hand-holding-heart text-purple-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-base text-green-600 font-medium">
                <i class="fas fa-arrow-up"></i> +15% from last month
            </span>
        </div>
    </div>

    <!-- Events Conducted -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-base font-medium text-gray-600">Events Conducted</p>
                <p class="text-3xl font-bold text-gray-900" id="events-conducted">-</p>
            </div>
            <div class="bg-indigo-100 p-3 rounded-full">
                <i class="fas fa-calendar-alt text-indigo-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-base text-green-600 font-medium">
                <i class="fas fa-arrow-up"></i> +5% from last month
            </span>
        </div>
    </div>

    <!-- Volunteers Approved -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-base font-medium text-gray-600">Volunteers Approved</p>
                <p class="text-3xl font-bold text-gray-900" id="volunteers-approved">-</p>
            </div>
            <div class="bg-teal-100 p-3 rounded-full">
                <i class="fas fa-hands-helping text-teal-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-base text-green-600 font-medium">
                <i class="fas fa-arrow-up"></i> +20% from last month
            </span>
        </div>
    </div>
</div>

</div>

<script>
    $(document).ready(function () {
        // Set up CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Load dashboard data
        loadDashboardData();

        // Refresh data every 30 seconds
        setInterval(loadDashboardData, 30000);

        function loadDashboardData() {
            $('#loading').removeClass('hidden');

            $.ajax({
                url: '{{ route("admin.dashboard") }}',
                method: 'GET',
                success: function (response) {
                    // Update all dashboard metrics
                    $('#total-ngos').text(formatNumber(response.total_ngos));
                    $('#total-users').text(formatNumber(response.total_users));
                    $('#pending-ngo-approvals').text(formatNumber(response.pending_ngo_approvals));
                    $('#pending-event-approvals').text(formatNumber(response.pending_event_approvals));
                    $('#reported-posts').text(formatNumber(response.reported_posts));
                    $('#total-donations').text('$' + formatNumber(response.total_donations));
                    $('#events-conducted').text(formatNumber(response.events_conducted));
                    $('#volunteers-approved').text(formatNumber(response.volunteers_approved));

                    $('#loading').addClass('hidden');
                },
                error: function (xhr, status, error) {
                    console.error('Error loading dashboard data:', error);
                    $('#loading').addClass('hidden');

                    // Show error message
                    showNotification('Error loading dashboard data. Please refresh the page.', 'error');
                }
            });
        }

        function formatNumber(num) {
            if (num >= 1000000) {
                return (num / 1000000).toFixed(1) + 'M';
            } else if (num >= 1000) {
                return (num / 1000).toFixed(1) + 'K';
            }
            return num.toString();
        }

        function showNotification(message, type = 'info') {
            const bgColor = type === 'error' ? 'bg-red-500' : 'bg-green-500';
            const notification = $(`
                    <div class="fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50">
                        ${message}
                    </div>
                `);

            $('body').append(notification);

            setTimeout(() => {
                notification.fadeOut(() => {
                    notification.remove();
                });
            }, 3000);
        }

        // Quick action button handlers
        $('button').on('click', function () {
            const buttonText = $(this).find('h3').text();
            if (buttonText && !$(this).hasClass('bg-red-500')) {
                showNotification(`${buttonText} feature coming soon!`, 'info');
            }
        });
    });
</script>
@endsection