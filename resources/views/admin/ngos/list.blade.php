@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-lg shadow-sm">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-semibold text-gray-800">NGO List</h1>
            <h3 class="text-sm text-gray-500 inline">List of all the registered NGOs</h3>
        </div>

        <!-- Search -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="grid grid-cols-2 gap-4">
                <input type="text" id="search-ngo-name" placeholder="Search By NGO Name"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                <input type="text" id="search-category" placeholder="Search By Category"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                <input type="text" id="search-address" placeholder="Search By Address"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                <input type="text" id="search-registration" placeholder="Search By Registration Number"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
            </div>
        </div>

        <!-- Table container -->
        <div class="overflow-x-auto" id="table-container">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-gray-800 font-semibold">S.N</th>
                        <th class="px-6 py-3 text-left text-gray-800 font-semibold">NGO Name</th>
                        <th class="px-6 py-3 text-left text-gray-800 font-semibold">Category</th>
                        <th class="px-6 py-3 text-left text-gray-800 font-semibold">Address</th>
                        <th class="px-6 py-3 text-left text-gray-800 font-semibold">Registration Number</th>
                    </tr>
                </thead>
                <tbody id="ngo-table-body" class="bg-white divide-y divide-gray-200">
                    <!-- Filled by JS -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between"
            id="pagination-container">
            <!-- Filled by JS -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function() {
            const route = '?ngo';
            let timeout;

            // ----- INPUT SEARCH (debounced) -----
            $('#search-ngo-name, #search-category, #search-address, #search-registration').on('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(() => fetchNgos(1), 350);
            });

            // ----- PAGINATION CLICK -----
            $(document).on('click', '#pagination-container a', function(e) {
                e.preventDefault();
                const url = new URL($(this).attr('href'));
                const page = url.searchParams.get('page') || 1;
                fetchNgos(page);
            });

            // ----- MAIN FETCH -----
            function fetchNgos(page = 1) {
                const params = {
                    page: page,
                    name: $('#search-ngo-name').val().trim(),
                    category: $('#search-category').val().trim(),
                    address: $('#search-address').val().trim(),
                    registration: $('#search-registration').val().trim(),
                };

                $.get(route, params, function(res) {
                    renderTable(res.ngos, res.current_page);
                    renderPagination(res.links, res.current_page);
                }).fail(() => alert('Error loading NGOs'));
            }

            // ----- RENDER TABLE -----
            function renderTable(ngos, page) {
                const tbody = $('#ngo-table-body').empty();

                if (ngos.length === 0) {
                    tbody.append(`
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">No NGOs found.</td>
                </tr>
            `);
                    return;
                }

                ngos.forEach((ngo, i) => {
                    const sn = (page - 1) * 10 + i + 1;
                    var routengodetail = "{{ route('admin.ngos.show', ':id') }}";
                    routengodetail = routengodetail.replace(':id', ngo.id);
                    const row = `
                <tr class="hover:bg-gray-50" data-ngo-id="${ngo.id}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <button class="expand-btn w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600 transition-colors mr-4"
                                    data-ngo-id="${ngo.id}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                            <span class="text-sm text-gray-900">${sn}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${escapeHtml(ngo.name)}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${escapeHtml(ngo.ngo.category)}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${escapeHtml(ngo.ngo.address)}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${escapeHtml(ngo.ngo.registration_number)}</td>
                </tr>
                <tr class="action-row hidden bg-red-50" id="action-row-${ngo.id}">
                    <td colspan="5" class="px-6 py-3">
                        <a href="${routengodetail}"
                           class="view-details-btn bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            View Details
                        </a>
                    </td>
                </tr>
            `;
                    tbody.append(row);
                });
            }

            // ----- RENDER PAGINATION -----
            function renderPagination(links, current) {
                const container = $('#pagination-container').empty();
                links.forEach(link => {
                    const active = link.label === current ? 'bg-red-600 text-white' :
                        'text-gray-700 hover:bg-gray-100';
                    const disabled = !link.url ? 'opacity-50 cursor-not-allowed' : '';
                    const html = link.url ?
                        `<a href="${link.url}" class="px-3 py-1 mx-1 rounded ${active} ${disabled}">${link.label}</a>` :
                        `<span class="px-3 py-1 mx-1 rounded ${disabled}">${link.label}</span>`;
                    container.append(html);
                });
            }

            // ----- EXPAND / COLLAPSE -----
            $(document).on('click', '.expand-btn', function() {
                const id = $(this).data('ngo-id');
                const row = $(`#action-row-${id}`);
                const icon = $(this).find('path');

                // close all
                $('.action-row').addClass('hidden');
                $('.expand-btn').removeClass('bg-red-600').addClass('bg-red-500')
                    .find('path').attr('d', 'M12 6v6m0 0v6m0-6h6m-6 0H6');

                if (row.hasClass('hidden')) {
                    row.removeClass('hidden');
                    icon.attr('d', 'M20 12H4');
                    $(this).removeClass('bg-red-500').addClass('bg-red-600');
                }
            });

            // ----- HELPERS -----
            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            // ----- INITIAL LOAD -----
            fetchNgos();
        });
    </script>
@endsection
