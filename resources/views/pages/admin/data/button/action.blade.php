<div class="flex items-center gap-2">
    @if ($row->status === \App\Constant::status['pending'])
        <button data-id="{{ $row->id }}" id="bApprove"
            class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded-md">
            <i class="fa fa-check text-xs"></i>
        </button>

        <button data-id="{{ $row->id }}" id="bReject"
            class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-md">
            <i class="fa fa-times text-xs"></i>
        </button>
    @endif

    <button data-id="{{ $row->id }}" id="bDetails"
        class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded-md">
        <i class="fa fa-eye text-xs"></i>
    </button>

    <button data-id="{{ $row->id }}" id="bDelete"
        class="bg-gray-700 hover:bg-gray-800 text-white px-2 py-1 rounded-md">
        <i class="fa fa-trash text-xs"></i>
    </button>

</div>
