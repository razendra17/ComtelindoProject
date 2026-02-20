@include('layouts.app')
<div class=" w-full overflow-y-0 overflow-x-auto rounded-xl shadow border border-slate-200 bg-white">
    <table id="data-table" class=" min-w-full text-sm text-left text-slate-700">
        <thead class="bg-slate-100 text-xs uppercase tracking-wider text-slate-600">
            <tr>
                <th class="px-4 py-3 text-center ">No</th>
                <th class="px-4 py-3 text-center">Name</th>
                <th class="px-4 py-3 text-center">Email</th>
                <th class="px-4 py-3 text-center">Phone</th>
                <th class="px-4 py-3 text-center">Package</th>
                <th class="px-4 py-3 text-center">City</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200 bg-white">
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('dashboard.data') }}",
            columns: [
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'number', name: 'number' },
                { data: 'package_name', name: 'package.name' },
                { data: 'city_name', name: 'package.city.name' },
            ]
        });
    });
    </script>

