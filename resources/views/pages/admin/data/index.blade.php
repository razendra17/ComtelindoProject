@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 p-6">

        <div class="bg-gray-200 rounded-2xl shadow-inner p-6">

            {{-- FILTER TOP --}}
            <div class="flex flex-col gap-4 mb-5">

                {{-- FILTER BUTTONS --}}
                <div class="flex items-center gap-3">

                    {{-- STATUS --}}
                    <div class="relative">
                        <button type="button" data-target="#filterStatusDropdown"
                            class="filter-btn px-4 py-2 bg-white rounded-lg text-sm font-medium text-gray-600 shadow-sm border border-gray-300 hover:bg-gray-50 transition">
                            Status
                        </button>

                        <div id="filterStatusDropdown"
                            class="filter-dropdown hidden absolute mt-2 w-40 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
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
                        <button type="button" data-target="#filterCityDropdown"
                            class="filter-btn px-4 py-2 bg-white rounded-lg text-sm font-medium text-gray-600 shadow-sm border border-gray-300">
                            City
                        </button>

                        <div id="filterCityDropdown"
                            class="filter-dropdown hidden absolute mt-2 w-48 bg-white rounded-lg shadow-lg border z-50">
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
                        <button type="button" data-target="#filterPackageDropdown"
                            class="filter-btn px-4 py-2 bg-white rounded-lg text-sm font-medium text-gray-600 shadow-sm border border-gray-300">
                            Package
                        </button>

                        <div id="filterPackageDropdown"
                            class="filter-dropdown hidden absolute mt-2 w-56 bg-white rounded-lg shadow-lg border z-50">
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

            <div class="ml-auto relative w-72">
                <input type="text" id="searchInput" placeholder="search id here"
                    class="w-full pl-4 pr-4 py-2 rounded-xl bg-white text-sm text-gray-500 placeholder-gray-400 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-300 shadow-sm">
            </div>

        </div>

        {{-- TABLE --}}
        <div class="p-4">

            <div class="bg-gray-100 rounded-2xl p-3">

                <table id="packageTable" class="w-full border-separate border-spacing-y-3 text-sm text-gray-700 ">
                    <thead>
                        <tr class="bg-gray-300 text-gray-700">
                            <th class="px-5 py-3 text-left rounded-l-xl">No</th>
                            <th class="px-5 py-3 text-left">Costumer id</th>
                            <th class="px-5 py-3 text-left">Package name</th>
                            <th class="px-5 py-3 text-left">City</th>
                            <th class="px-5 py-3 text-left">Status</th>
                            <th class="px-5 py-3 text-left rounded-r-xl">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
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
            let selectedStatus = '';

            let table = $('#packageTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('dashboard.data') }}",
                    data: function(d) {
                        d.city_id = selectedCity;
                        d.package_id = selectedPackage;
                        d.status = selectedStatus;
                    }
                },
                searching: true,
                paging: false,
                dom: 'rtp',
                info: false,
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'customer_id',
                        name: 'customer_id'
                    },
                    {
                        data: 'package.name',
                        name: 'package.name'
                    },
                    {
                        data: 'package.city.name',
                        name: 'package.city.name'
                    },
                    {
                        data: 'status_badge',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // ===============================
            // UNIVERSAL DROPDOWN SYSTEM
            // ===============================

            $(document).on('click', '.filter-btn', function(e) {
                e.stopPropagation();

                let target = $(this).data('target');

                $('.filter-dropdown').not(target).addClass('hidden');
                $(target).toggleClass('hidden');
            });

            $(document).on('click', function() {
                $('.filter-dropdown').addClass('hidden');
            });

            // ===============================
            // ACTIVE FILTER INDICATOR
            // ===============================
            function renderActiveFilters() {

                let container = $('#activeFilters');
                container.empty();

                if (selectedStatus) {
                    container.append(`
            <span class="filter-badge filter-status">
                Status: ${capitalize(selectedStatus)}
                <button class="remove-filter filter-remove" data-type="status">✕</button>
            </span>
        `);
                }

                if (selectedCity) {
                    let cityText = $('.city-option[data-value="' + selectedCity + '"]').text().trim();

                    container.append(`
            <span class="filter-badge filter-city">
                City: ${cityText}
                <button class="remove-filter filter-remove" data-type="city">✕</button>
            </span>
        `);
                }

                if (selectedPackage) {
                    let packageText = $('.package-option[data-value="' + selectedPackage + '"]').text().trim();

                    container.append(`
            <span class="filter-badge filter-package">
                Package: ${packageText}
                <button class="remove-filter filter-remove" data-type="package">✕</button>
            </span>
        `);
                }
            }

            function capitalize(text) {
                return text.charAt(0).toUpperCase() + text.slice(1);
            }

            // ===============================
            // STATUS FILTER
            // ===============================

            $(document).on('click', '.status-option', function() {

                selectedStatus = $(this).data('value');
                table.ajax.reload();
                renderActiveFilters();

                $('.filter-dropdown').addClass('hidden');
            });

            // ===============================
            // CITY FILTER
            // ===============================

            $(document).on('click', '.city-option', function() {

                selectedCity = $(this).data('value');
                table.ajax.reload();
                renderActiveFilters();

                $('.filter-dropdown').addClass('hidden');
            });

            // ===============================
            // PACKAGE FILTER
            // ===============================

            $(document).on('click', '.package-option', function() {

                selectedPackage = $(this).data('value');
                table.ajax.reload();
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

                table.ajax.reload();
                renderActiveFilters();
            });

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

                        $.ajax({
                            url: `/dashboard/data/${id}/approve`,
                            type: "PUT",
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            success: function() {
                                table.ajax.reload();
                                toastr.success(
                                    'Pengajuan berhasil disetujui & berhasil mengirim email ke user'
                                );
                            },
                            error: function() {
                                toastr.error(
                                    'Gagal menyetujui atau gagal mengirim email!'
                                );
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
                            url: `/dashboard/data/${id}`,
                            type: "DELETE",
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            success: function() {
                                table.ajax.reload();
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

                        $.ajax({
                            url: `/dashboard/data/${id}/reject`,
                            type: "PUT",
                            data: {
                                reason: reason
                            },
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            success: function() {
                                $('#rejectModal').addClass('hidden').removeClass(
                                    'flex');
                                table.ajax.reload();
                                toastr.success(
                                    'Request berhasil ditolak & berhasil mengirim email!'
                                );
                            },
                            error: function() {
                                toastr.error(
                                    'Gagal reject atau gagal emngirim email!');
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
