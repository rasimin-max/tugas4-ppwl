@props([
    'href' => null,
    'type' => 'button',
    'variant' => 'primary',
])

@php
    $variantClass = match ($variant) {
        'secondary' => 'button-secondary',
        'quiet' => 'button-quiet',
        default => 'button-primary',
    };
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class(['button', $variantClass]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->class(['button', $variantClass]) }}>{{ $slot }}</button>
@endif
