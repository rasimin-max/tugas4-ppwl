@props([
    'title' => null,
    'description' => null,
])

<section {{ $attributes->class(['card', 'panel']) }}>
    @if ($title || $description || isset($heading) || isset($actions))
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
            {{ $actions ?? '' }}
        </header>
    @endif

    {{ $slot }}
</section>
