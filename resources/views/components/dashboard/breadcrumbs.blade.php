@props(['title', 'description' => null])

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>{{ $title ?? '' }}</h1>
            @if ($description)
                <span>{{ $description }}</span>
            @endif
        </div>
    </div>
</div>
