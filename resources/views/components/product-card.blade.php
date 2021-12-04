<div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex flex-column">
    <div class="card product-card text-center flex-grow flex-fill shadow">
        <a href="/products/{{$record->id}}">
            @if(count($gallery) >= 1)
            <img src="/images/{{ $gallery->first()->image_source }}" alt="Arduino" class="img-fluid" />
            @else
            <img src="s" alt="No available image" class="img-fluid" />
            @endif
        </a>
        <hr>
        <section class="card-body mt-auto">
            <a href="/products/{{$record->id}}"><h3 class="text-truncate">{{ $record->name }}</h3></a>
            <div class="card-body">
                $ {{ $record->price }}
            </div>
        </section>
    </div>
</div>