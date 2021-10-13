@props([
    'size' => 'md',
    'tag' => 'button'
])

@php
    $sizeClass = 'px-4 py-2';
    if ($size == 'sm') {
        $sizeClass = 'px-2 py-1 text-xs';
    }
@endphp

<{{ $tag }} {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center ' . $sizeClass . ' bg-gray-800 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</{{ $tag }}>
