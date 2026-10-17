@props([
    'variant' => 'neutral',
])

@php
    $variantClass = match ($variant) {
        'success' => 'badge-success',
        'warning' => 'badge-warning',
        'danger' => 'badge-danger',
        'info' => 'badge-info',
        default => 'badge-neutral',
    };
@endphp

<span {{ $attributes->class(['badge', $variantClass]) }}>{{ $slot }}</span>
