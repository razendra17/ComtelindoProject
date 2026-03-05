<!-- Overlay -->
<div id="rejectModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">

    <!-- Card -->
    <div class="bg-red-600 w-[420px] rounded-2xl shadow-2xl relative p-6 animate-scaleIn">

        <!-- Header Badge -->
        <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-red-500 text-white text-xs px-4 py-1 rounded-lg shadow">
            are you sure want to reject?
        </div>

        <!-- Body -->
        <div class="mt-6">
            <select id="reject_reason"
                class="w-full px-4 py-2 rounded-full bg-gray-100 text-sm text-gray-600
                       focus:outline-none focus:ring-2 focus:ring-white">
        
                <option value="">Select rejection message</option>
        
                @foreach($reason as $key => $message)
                    <option value="{{ $message }}">{{ $message }}</option>
                @endforeach
        
            </select>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 mt-6">
            <button id="closeReject"
                class="px-4 py-1 text-xs bg-gray-400 text-white rounded-full hover:bg-gray-500 transition">
                Cancel
            </button>

            <button
                id="uRejection" class="px-4 py-1 text-xs bg-red-500 text-white rounded-full hover:bg-red-700 transition">
                Confirm
            </button>
        </div>

    </div>
</div>