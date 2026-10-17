<div {{ $attributes->class(['table-wrap']) }}>
    <table class="data-table">
        <thead>
            <tr>{{ $head }}</tr>
        </thead>
        <tbody>{{ $slot }}</tbody>
    </table>
</div>
