<div class="card w-100">
    <div class="card-body" style="background-color: #d9f5ff;">
        <h5 class="card-title text-dark">{{ $title }}</h5>
        @if (isset($subtitle))
            <p class="card-subtitle mb-2 text-muted">
                {{ $subtitle }}
            </p>
        @endif
        
    </div>
    <ul class="list-group list-group-flush">
        {{ $items }}
    </ul>
</div>