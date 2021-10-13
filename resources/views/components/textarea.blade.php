@props([
    'disabled' => false,
])

@php
    $defaultClass = 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50';
    if ($disabled) {
        $defaultClass .= ' bg-gray-200 text-gray-500';
    }
@endphp

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $defaultClass]) !!}>{{ $slot }}</textarea>
