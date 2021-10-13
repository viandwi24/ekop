@props([
    'active' => false,
    'key' => '',
])

<div class="@if ($active) block @else hidden @endif" id="tab-{{ $key }}">
    {{ $slot }}
</div>
