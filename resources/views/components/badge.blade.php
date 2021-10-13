@props([
    'type' => 'success',
    'text' => ''
])

<span class="badge text-xs rounded @if ($type == 'success') bg-green-500 text-white @elseif ($type == 'danger') bg-red-500 text-white @endif px-2 py-1">
    {{ $text }} {{ $slot }}
</span>
