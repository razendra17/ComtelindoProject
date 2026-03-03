@php
    $class = match ($row->status) {
        'approved' => 'bg-green-300 text-green-700',
        'rejected' => 'bg-red-300 text-red-700',
        default => 'bg-yellow-300 text-yellow-700',
    };
@endphp

<span class="px-3 py-1 rounded-full text-sm font-semibold {{ $class }}">
    {{ ucfirst($row->status) }}
</span>
