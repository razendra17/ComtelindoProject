@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 p-6">

        <div class="bg-gray-200 rounded-2xl shadow-inner p-6">

            {{-- FILTER TOP --}}
            <div class="flex items-center gap-3 mb-5">

                <button
                    class="px-4 py-2 bg-white rounded-lg text-sm font-medium text-gray-600 shadow-sm border border-gray-300 hover:bg-gray-50 transition">
                    status
                </button>

                <button
                    class="px-4 py-2 bg-white rounded-lg text-sm font-medium text-gray-600 shadow-sm border border-gray-300 hover:bg-gray-50 transition">
                    city
                </button>

                <button
                    class="px-4 py-2 bg-white rounded-lg text-sm font-medium text-gray-600 shadow-sm border border-gray-300 hover:bg-gray-50 transition">
                    package
                </button>

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

            let table = $('#packageTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dashboard.data') }}",
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
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            $('#searchInput').keyup(function() {
                table.column(1).search(this.value).draw();
            });

            $(document).on('click', '#bApprove', function() {

                let id = $(this).data('id');

                $.ajax({
                    url: `/dashboard/data/${id}/approve`,
                    type: "PUT",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });

            });

            $(document).on('click', '#bReject', function() {
                $('#rejectModal').removeClass('hidden').addClass('flex');
                let id = $(this).data('id');
                $('#uRejection').data('id', id);
            });

            // tutup modal
            $('#closeReject').on('click', function() {
                $('#rejectModal').addClass('hidden').removeClass('flex');
            });

            // klik luar modal untuk close
            $('#rejectModal').on('click', function(e) {
                if (e.target === this) {
                    $(this).addClass('hidden').removeClass('flex');
                }
            });

            $(document).on('click', '#uRejection', function() {
                let id = $(this).data('id');
                let reason = $('#reject_reason').val();
                $.ajax({
                    url: `/dashboard/data/${id}/reject`,
                    type: "PUT",
                    data: {
                        reason: reason
                    },
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        $('#rejectModal').addClass('hidden').removeClass('flex');
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });

            });
        });
    </script>
@endsection
