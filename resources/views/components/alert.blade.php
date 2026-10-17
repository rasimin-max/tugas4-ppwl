@props([
    'variant' => 'info',
])

@php
    $variantClass = match ($variant) {
        'success' => 'alert-success',
        'warning' => 'alert-warning',
        'error' => 'alert-error',
        default => 'alert-info',
    };
@endphp

<div {{ $attributes->class(['alert', $variantClass]) }} role="status" aria-live="polite">
    <span class="alert-mark" aria-hidden="true">
        {{ match ($variant) { 'success' => '✓', 'warning' => '!', 'error' => '×', default => 'i' } }}
    </span>
    <div>{{ $slot }}</div>
</div>
