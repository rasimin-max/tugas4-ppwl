@props([
    'title' => 'Belum ada data',
    'description' => 'Data akan ditampilkan di sini setelah tersedia.',
])

<div {{ $attributes->class(['empty-state']) }}>
    <span class="empty-state-icon" aria-hidden="true">▤</span>
    <h3>{{ $title }}</h3>
    <p>{{ $description }}</p>
    @if (trim((string) $slot) !== '')
        <div class="empty-state-action">{{ $slot }}</div>
    @endif
</div>
