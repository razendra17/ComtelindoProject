@php
    $class = match ($row->status) {
        'approved' => 'bg-green-100 text-green-700',
        'rejected' => 'bg-red-100 text-red-700',
        default => 'bg-yellow-100 text-yellow-700',
    };

    $dot = match ($row->status) {
        'approved' => 'bg-green-500',
        'rejected' => 'bg-red-500',
        default => 'bg-yellow-500',
    };
@endphp

<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $class }}">
    <span class="w-2 h-2 rounded-full {{ $dot }}"></span>
    {{ ucfirst($row->status) }}
</span>
