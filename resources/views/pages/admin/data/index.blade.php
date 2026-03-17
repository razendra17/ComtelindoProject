@extends('layouts.app')

@section('content')
    <div class="min-h-scree p-6">

        @include('pages.admin.data.partials.searchbar')

        {{-- FILTER TOP --}}
        <div class="flex flex-col gap-4 mb-5">

            {{-- FILTER BUTTONS --}}
            <div class="flex items-center gap-3">

                {{-- STATUS --}}
                <div class="relative">
                    <div class="relative group">
                        <button type="button" data-target="#filterStatusDropdown"
                            class="filter-btn flex items-center gap-2 px-4 py-2 bg-white rounded-lg text-sm font-medium text-gray-600 shadow-sm border
                          border-gray-300 transition transform duration-200 ease-out hover:scale-110 hover:shadow-md hover:text-white hover:bg-amber-500">

                            Status

                            <svg class="dropdown-arrow w-4 h-4 transition-transform duration-200"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />

                            </svg>

                        </button>
                        <div
                            class="filter-tooltip absolute left-1/2 -translate-x-1/2 top-full mt-2 opacity-0 pointer-events-none
                                bg-gray-800 text-white text-xs px-3 py-1 rounded-md whitespace-nowrap translate-y-1 
                                transition-all duration-200 group-hover:opacity-100 group-hover:translate-y-0">
                            Filter berdasarkan status pesanan
                        </div>

                    </div>
                    <div id="filterStatusDropdown"
                        class="filter-dropdown hidden absolute mt-2 w-40 bg-white rounded-xl shadow-lg border border-gray-200 z-50 origin-top transform transition-all duration-200 scale-95 opacity-0">
                        <ul class="text-sm text-gray-700">
                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer status-option" data-value="">
                                All
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer status-option" data-value="pending">
                                Pending
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer status-option" data-value="approved">
                                Approved
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer status-option" data-value="rejected">
                                Rejected
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- CITY --}}
                <div class="relative">
                    <div class="relative group">

                        <button type="button" data-target="#filterCityDropdown"
                            class="filter-btn flex items-center gap-2 px-4 py-2 bg-white rounded-lg text-sm font-medium text-gray-600 shadow-sm border
                          border-gray-300 transition transform duration-200 ease-out hover:scale-110 hover:shadow-md hover:text-white hover:bg-amber-500">

                            Cities

                            <svg class="dropdown-arrow w-4 h-4 transition-transform duration-200"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />

                            </svg>

                        </button>
                        <div
                            class="filter-tooltip absolute left-1/2 -translate-x-1/2 top-full mt-2 opacity-0 pointer-events-none
                                bg-gray-800 text-white text-xs px-3 py-1 rounded-md whitespace-nowrap translate-y-1 
                                transition-all duration-200 group-hover:opacity-100 group-hover:translate-y-0">
                            Filter berdasarkan Kota pesanan
                        </div>

                    </div>

                    <div id="filterCityDropdown"
                        class="filter-dropdown hidden absolute mt-2 w-40 bg-white rounded-xl shadow-lg border border-gray-200 z-50 origin-top transform transition-all duration-200 scale-95 opacity-0">
                        <ul class="text-sm text-gray-700 max-h-60 overflow-y-auto">
                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer city-option" data-value="">
                                All
                            </li>

                            @foreach ($cities as $city)
                                <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer city-option"
                                    data-value="{{ $city->id }}">
                                    {{ $city->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- PACKAGE --}}
                <div class="relative">
                    <div class="relative group">

                        <button type="button" data-target="#filterPackageDropdown"
                            class="filter-btn flex items-center gap-2 px-4 py-2 bg-white rounded-lg text-sm font-medium text-gray-600 shadow-sm border
                          border-gray-300 transition transform duration-200 ease-out hover:scale-110 hover:shadow-md hover:text-white hover:bg-amber-500">

                            Package

                            <svg class="dropdown-arrow w-4 h-4 transition-transform duration-200"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />

                            </svg>

                        </button>
                        <div
                            class="filter-tooltip absolute left-1/2 -translate-x-1/2 top-full mt-2 opacity-0 pointer-events-none
                                bg-gray-800 text-white text-xs px-3 py-1 rounded-md whitespace-nowrap translate-y-1 
                                transition-all duration-200 group-hover:opacity-100 group-hover:translate-y-0">
                            Filter berdasarkan Package pesanan
                        </div>

                    </div>
                    <div id="filterPackageDropdown"
                        class="filter-dropdown hidden absolute mt-2 w-40 bg-white rounded-xl shadow-lg border border-gray-200 z-50 origin-top transform transition-all duration-200 scale-95 opacity-0">
                        <ul class="text-sm text-gray-700 max-h-60 overflow-y-auto">
                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer package-option" data-value="">
                                All
                            </li>

                            @foreach ($packages as $package)
                                <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer package-option"
                                    data-value="{{ $package->id }}">
                                    {{ $package->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

            <div id="activeFilters" class="flex flex-wrap gap-2"></div>

        </div>

        {{-- TABLE --}}
        <div class="">

            <div class=" rounded-2xl p-3">

             <table id="packageTable" class="w-full border-separate border-spacing-y-2 text-sm text-gray-700">
                    <thead>
                       <tr class="bg-amber-500 text-white shadow-sm">
                            <th class="px-5 py-4 text-left rounded-l-xl">No</th>
                            <th class="px-5 py-4 text-left">Package name</th>
                            <th class="px-5 py-4 text-left">City</th>
                            <th class="px-5 py-4 text-left">Status</th>
                            <th class="px-5 py-4 text-left">Submitted At</th>
                            <th class="px-5 py-4 text-left rounded-r-xl">Action</th>
                        </tr>
                    </thead>
                    <tbody
                        class="[&>tr]:bg-white [&>tr]:transition [&>tr]:duration-200 [&>tr:hover]:shadow-md [&>tr:hover]:scale-[1.01] [&>tr:hover]:bg-gray-50">
                    </tbody>
                </table>

            </div>

        </div>
    </div>
    </div>
@endsection

@include('pages.admin.data.modal.reject')

@section('script')
    <script>
        $(function() {

            let selectedCity = '';
            let selectedPackage = '';
            let selectedStatus = 'pending';

            let table = $('#packageTable').DataTable({
                processing: true,
                serverSide: true,
                paging: true,
                dom: 'rtp',

                ajax: {
                    url: "{{ route('dashboard.data') }}",
                    data: function(d) {
                        d.city_id = selectedCity;
                        d.package_id = selectedPackage;
                        d.status = selectedStatus;
                    }
                },
                searching: true,
                info: false,

                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'package.name',
                        name: 'package.name',
                        orderable: false,
                    },
                    {
                        data: 'package.city.name',
                        name: 'package.city.name',
                        orderable: false,
                    },
                    {
                        data: 'status',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'submitted_at',
                        name: 'created_at',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                pageLength: 5,
            });

            $(document).ready(function() {
                renderActiveFilters();
            });

            // ===============================
            // UNIVERSAL DROPDOWN SYSTEM (ARROW FIX)
            // ===============================

            $(document).on('click', '.filter-btn', function(e) {

                e.stopPropagation();

                let target = $(this).data('target');
                let dropdown = $(target);
                let arrow = $(this).find('.dropdown-arrow');

                // reset semua arrow dulu
                $('.dropdown-arrow').removeClass('rotate-180');

                // tutup dropdown lain
                $('.filter-dropdown').not(dropdown).each(function() {

                    $(this)
                        .removeClass('scale-100 opacity-100')
                        .addClass('scale-95 opacity-0');

                    let el = $(this);

                    setTimeout(function() {
                        el.addClass('hidden');
                    }, 200);

                });

                // buka dropdown
                if (dropdown.hasClass('hidden')) {

                    dropdown.removeClass('hidden');

                    setTimeout(function() {

                        dropdown
                            .removeClass('scale-95 opacity-0')
                            .addClass('scale-100 opacity-100');

                    }, 10);

                    arrow.addClass('rotate-180');
                    $(this).find('.filter-tooltip').addClass('opacity-0');

                }
                // tutup dropdown jika klik tombol lagi
                else {

                    dropdown
                        .removeClass('scale-100 opacity-100')
                        .addClass('scale-95 opacity-0');
                    $(this).find('.filter-tooltip').removeClass('opacity-0');

                    setTimeout(function() {
                        dropdown.addClass('hidden');
                    }, 200);

                }

            });


            // klik di luar dropdown
            $(document).on('click', function() {

                $('.filter-dropdown').each(function() {

                    $(this)
                        .removeClass('scale-100 opacity-100')
                        .addClass('scale-95 opacity-0');

                    let el = $(this);

                    setTimeout(function() {
                        el.addClass('hidden');
                    }, 200);

                });

                // reset arrow juga
                $('.dropdown-arrow').removeClass('rotate-180');

            });


            // klik luar dropdown
            $(document).on('click', function() {

                $('.filter-dropdown').each(function() {

                    $(this)
                        .removeClass('scale-100 opacity-100')
                        .addClass('scale-95 opacity-0');
                    $('.dropdown-arrow').removeClass('rotate-180');

                    let el = $(this);

                    setTimeout(function() {
                        el.addClass('hidden');
                    }, 200);

                });

            });

            // ===============================
            // CITY FILTER
            // ===============================

            $(document).on('click', '.city-option', function() {

                selectedCity = $(this).data('value');
                table.ajax.reload(null, false);
                renderActiveFilters();

                $('.filter-dropdown').addClass('hidden');
            });

            // ===============================
            // STATUS FILTER
            // ===============================

            $(document).on('click', '.status-option', function() {

                selectedStatus = $(this).data('value');

                table.ajax.reload(null, false);
                renderActiveFilters();

                $('.filter-dropdown').addClass('hidden');

            });

            // ===============================
            // PACKAGE FILTER
            // ===============================

            $(document).on('click', '.package-option', function() {

                selectedPackage = $(this).data('value');
                table.ajax.reload(null, false);
                renderActiveFilters();

                $('.filter-dropdown').addClass('hidden');
            });

            // ===============================
            // REMOVE FILTER
            // ===============================

            $(document).on('click', '.remove-filter', function() {

                let type = $(this).data('type');

                if (type === 'status') selectedStatus = '';
                if (type === 'city') selectedCity = '';
                if (type === 'package') selectedPackage = '';

                table.ajax.reload(null, false);
                renderActiveFilters();
            });
            // ===============================
            // ACTIVE FILTER INDICATOR
            // ===============================
            function renderActiveFilters() {
                const container = $('#activeFilters');
                container.empty();

                const filters = [{
                        value: selectedStatus,
                        type: 'status',
                        label: 'Status',
                        text: capitalize(selectedStatus)
                    },
                    {
                        value: selectedCity,
                        type: 'city',
                        label: 'City',
                        text: getText('.city-option', selectedCity)
                    },
                    {
                        value: selectedPackage,
                        type: 'package',
                        label: 'Package',
                        text: getText('.package-option', selectedPackage)
                    }
                ];

                filters.forEach(f => addFilter(container, f.value, f.type, f.label, f.text));
            }

            function addFilter(container, value, type, label, text) {
                if (!value) return;

                container.append(`
        <span class="filter-badge filter-${type}">
            ${label}: ${text}
            <button class="remove-filter filter-remove" data-type="${type}">✕</button>
        </span>
    `);
            }

            function getText(selector, value) {
                return $(`${selector}[data-value="${value}"]`).text().trim();
            }

            function capitalize(text) {
                return text.charAt(0).toUpperCase() + text.slice(1);
            }

            // ===============================
            // STATUS FILTER
            // ===============================


            // ===============================
            // SEARCH
            // ===============================

            $('#searchInput').keyup(function() {
                table.column(1).search(this.value).draw();
            });

            // ===============================
            // APPROVE
            // ===============================

            $(document).on('click', '#bApprove', function(e) {
                e.preventDefault();
                let id = $(this).data('id');

                confirmAction({
                    title: 'Yakin approve?',
                    text: 'Data akan disetujui!',
                    confirmText: 'Ya, approve!',
                    onConfirm: function() {

                        // toastr loading dulu
                        let loadingToast = toastr.info('Sedang mengirim email...',
                            'Processing', {
                                timeOut: 0,
                                extendedTimeOut: 0
                            });

                        $.ajax({
                            url: `/admin/data/${id}/approve`,
                            type: "PUT",
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            success: function() {

                                table.ajax.reload(null, false);

                                toastr.clear(loadingToast); // hapus loading

                                toastr.success(
                                    'Pengajuan berhasil disetujui & email berhasil dikirim!'
                                );
                            },
                            error: function() {

                                toastr.clear(loadingToast);

                                toastr.error(
                                    'Gagal menyetujui & gagal mengirim email!');
                            }
                        });

                    }
                });

            });

            // ===============================
            // DELETE
            // ===============================

            $(document).on('click', '#bDelete', function() {

                let id = $(this).data('id');

                confirmAction({
                    title: 'Yakin hapus?',
                    text: 'Data tidak bisa dikembalikan!',
                    confirmText: 'Ya, hapus!',
                    onConfirm: function() {

                        $.ajax({
                            url: `/admin/data/${id}`,
                            type: "DELETE",
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            success: function() {
                                table.ajax.reload(null, false);
                                toastr.success('Data berhasil dihapus!');
                            },
                            error: function() {
                                toastr.error('Gagal hapus!');
                            }
                        });

                    }
                });

            });

            // ===============================
            // REJECT MODAL
            // ===============================

            $(document).on('click', '#bReject', function() {
                $('#rejectModal').removeClass('hidden').addClass('flex');
                $('#uRejection').data('id', $(this).data('id'));
            });

            $('#closeReject').on('click', function() {
                $('#rejectModal').addClass('hidden').removeClass('flex');
            });

            $('#rejectModal').on('click', function(e) {
                if (e.target === this) {
                    $(this).addClass('hidden').removeClass('flex');
                }
            });

            $(document).on('click', '#uRejection', function() {

                let id = $(this).data('id');
                let reason = $('#reject_reason').val();

                if (!reason) {
                    toastr.warning('Alasan wajib diisi!');
                    return;
                }

                confirmAction({
                    title: 'Yakin reject?',
                    text: 'Data akan ditolak!',
                    confirmText: 'Ya, reject!',
                    onConfirm: function() {

                        let loadingToast = toastr.info('Sedang mengirim email...',
                            'Processing', {
                                timeOut: 0,
                                extendedTimeOut: 0
                            });

                        $('#rejectModal').addClass('hidden').removeClass(
                            'flex');

                        $.ajax({
                            url: `/admin/data/${id}/reject`,
                            type: "PUT",
                            data: {
                                reason: reason
                            },
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            success: function() {


                                table.ajax.reload(null, false);

                                toastr.clear(loadingToast);

                                toastr.success(
                                    'Request berhasil ditolak & email berhasil dikirim!'
                                );
                            },
                            error: function() {

                                toastr.clear(loadingToast);

                                toastr.error(
                                    'Gagal reject & gagal mengirim email!');
                            }
                        });
                    }
                });

            });

        });

        // ===============================
        // SWEET ALERT WRAPPER
        // ===============================

        function confirmAction(options) {
            Swal.fire({
                title: options.title || 'Yakin?',
                text: options.text || '',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: options.confirmText || 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    options.onConfirm();
                }
            });
        }
    </script>
@endsection
