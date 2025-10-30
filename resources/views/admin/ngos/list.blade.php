@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-lg shadow-sm">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-semibold text-gray-800">NGO List</h1>
            <h3 class="text-sm text-gray-500 inline">List of all the registered NGOs</h3>
        </div>

        <!-- Search Filters -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <input type="text" id="search-ngo-name" placeholder="Search By NGO Name"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                </div>
                <div>
                    <input type="text" id="search-category" placeholder="Search By Category"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                </div>
                <div>
                    <input type="text" id="search-address" placeholder="Search By Address"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                </div>
                <div>
                    <input type="text" id="search-registration" placeholder="Search By Registration Number"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-gray-800 font-semibold">S.N</th>
                        <th class="px-6 py-3 text-left text-gray-800 font-semibold">NGO Name
                        </th>
                        <th class="px-6 py-3 text-left text-gray-800 font-semibold">Category
                        </th>
                        <th class="px-6 py-3 text-left text-gray-800 font-semibold">Address
                        </th>
                        <th class="px-6 py-3 text-left text-gray-800 font-semibold">
                            Registration Number</th>
                    </tr>
                </thead>
                <tbody id="ngo-table-body" class="bg-white divide-y divide-gray-200">

                    @forelse($ngos as $ngo)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <button
                                        class="expand-btn w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600 transition-colors mr-4"
                                        data-ngo-id="{{$ngo->id}}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </button>
                                    <span class="text-sm text-gray-900">{{ $ngos->firstItem() }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$ngo->name}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$ngo->ngo->category}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$ngo->ngo->address}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$ngo->ngo->registration_number}}
                            </td>
                        </tr>
                        <tr class="action-row hidden" id="action-row-{{ $ngo->id }}">
                            <td colspan="5" class="px-6 py-3 bg-red-50">
                                {{-- <a href="{{ route('admin.ngos.show') }}"> --}}
                                    <a
                                        class="view-details-btn bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors"
                                        data-ngo-id="{{$ngo->id}}" href="{{ route('admin.ngos.show',$ngo->id) }}">
                                        View Details
                                    </a>
                                {{-- </a> --}}
                            </td>
                        </tr>
                    @empty
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap colspan-5">No NGOs to show!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
            {{ $ngos->links() }}

        </div>

        <!-- jQuery and AJAX Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                // Toggle expand/collapse functionality
                $('.expand-btn').click(function () {
                    const ngoId = $(this).data('ngo-id');
                    const actionRow = $('#action-row-' + ngoId);
                    const icon = $(this).find('svg path');

                    if (actionRow.hasClass('hidden')) {
                        // Close all other action rows
                        $('.action-row').addClass('hidden');
                        $('.expand-btn svg path').attr('d', 'M12 6v6m0 0v6m0-6h6m-6 0H6');
                        $('.expand-btn').removeClass('bg-red-600').addClass('bg-red-500');

                        // Open current action row
                        actionRow.removeClass('hidden');
                        icon.attr('d', 'M18 12H6');
                        $(this).removeClass('bg-red-500').addClass('bg-red-600');
                    } else {
                        // Close current action row
                        actionRow.addClass('hidden');
                        icon.attr('d', 'M12 6v6m0 0v6m0-6h6m-6 0H6');
                        $(this).removeClass('bg-red-600').addClass('bg-red-500');
                    }
                });

                // View Details button functionality
                $('.view-details-btn').click(function () {
                    const ngoId = $(this).data('ngo-id');

                    // AJAX call to get NGO details
                    $.ajax({
                        url: '/ngo/details/' + ngoId,
                        type: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            // Handle success - you can show a modal or redirect
                            console.log('NGO Details:', response);
                            // Example: window.location.href = '/ngo/details/' + ngoId;
                            alert('Viewing details for NGO ID: ' + ngoId);
                        },
                        error: function (xhr, status, error) {
                            console.error('Error fetching NGO details:', error);
                            alert('Error loading NGO details. Please try again.');
                        }
                    });
                });

                // Search functionality
                let searchTimeout;

                $('#search-ngo-name, #search-category, #search-address, #search-registration').on('input', function () {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(function () {
                        performSearch();
                    }, 500);
                });

                function performSearch() {
                    const searchData = {
                        ngo_name: $('#search-ngo-name').val(),
                        category: $('#search-category').val(),
                        address: $('#search-address').val(),
                        registration_number: $('#search-registration').val()
                    };

                    $.ajax({
                        url: '/ngo/search',
                        type: 'GET',
                        data: searchData,
                        dataType: 'json',
                        success: function (response) {
                            updateTable(response.data);
                        },
                        error: function (xhr, status, error) {
                            console.error('Search error:', error);
                        }
                    });
                }

                function updateTable(ngos) {
                    const tbody = $('#ngo-table-body');
                    tbody.empty();

                    ngos.forEach(function (ngo, index) {
                        const row = `
                                                    <tr class="hover:bg-gray-50">
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="flex items-center">
                                                                <button class="expand-btn w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600 transition-colors mr-3" data-ngo-id="${ngo.id}">
                                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                                    </svg>
                                                                </button>
                                                                <span class="text-sm text-gray-900">${index + 1}</span>
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${ngo.name}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${ngo.category}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${ngo.address}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${ngo.registration_number}</td>
                                                    </tr>
                                                    <tr class="action-row hidden" id="action-row-${ngo.id}">
                                                        <td colspan="5" class="px-6 py-3 bg-red-50">
                                                            <button class="view-details-btn bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors" data-ngo-id="${ngo.id}">
                                                                View Details
                                                            </button>
                                                        </td>
                                                    </tr>
                                                `;
                        tbody.append(row);
                    });

                    // Reattach event listeners
                    attachEventListeners();
                }

                function attachEventListeners() {
                    $('.expand-btn').off('click').on('click', function () {
                        const ngoId = $(this).data('ngo-id');
                        const actionRow = $('#action-row-' + ngoId);
                        const icon = $(this).find('svg path');

                        if (actionRow.hasClass('hidden')) {
                            $('.action-row').addClass('hidden');
                            $('.expand-btn svg path').attr('d', 'M12 6v6m0 0v6m0-6h6m-6 0H6');
                            $('.expand-btn').removeClass('bg-red-600').addClass('bg-red-500');

                            actionRow.removeClass('hidden');
                            icon.attr('d', 'M18 12H6');
                            $(this).removeClass('bg-red-500').addClass('bg-red-600');
                        } else {
                            actionRow.addClass('hidden');
                            icon.attr('d', 'M12 6v6m0 0v6m0-6h6m-6 0H6');
                            $(this).removeClass('bg-red-600').addClass('bg-red-500');
                        }
                    });

                    $('.view-details-btn').off('click').on('click', function () {
                        const ngoId = $(this).data('ngo-id');
                        // alert(ngoId);

                        $.ajax({
                            url: '/ngo' + ngoId,
                            type: 'GET',
                            dataType: 'json',
                            success: function (response) {
                                console.log('NGO Details:', response);
                                alert('Viewing details for NGO ID: ' + ngoId);
                            },
                            error: function (xhr, status, error) {
                                console.error('Error fetching NGO details:', error);
                                alert('Error loading NGO details. Please try again.');
                            }
                        });
                    });
                }
            });
        </script>

@endsection