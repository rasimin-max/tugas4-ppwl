@props([
    'title' => null,
    'description' => null,
])

<section {{ $attributes->class(['card']) }}>
    @if ($title || $description)
        <header class="card-heading">
            <div>
                @if ($title)
                    <h2>{{ $title }}</h2>
                @endif
                @if ($description)
                    <p>{{ $description }}</p>
                @endif
            </div>
            {{ $heading ?? '' }}
        </header>
    @endif

    {{ $slot }}
</section>
