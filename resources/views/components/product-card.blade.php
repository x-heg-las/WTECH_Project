<div class="col-12 col-sm-6 col-md-4 col-lg-3">
    <div class="card product-card text-center">
        <a href="#">
            @if(count($gallery) >= 1)
                <img src="images/{{ $gallery->first()->image_source }}" alt="Arduino" class="img-fluid" />
            @else
            <img src="s" alt="No available image" class="img-fluid" />
            @endif
        </a>
        <section>
            <div class="card-body">
                <a href="#"><h3 class="text-truncate">{{ $record->name }}</h3></a>
            </div>
            <div class="card-body">
                {{ $record->price }}
            </div>
        </section>
    </div>
</div>
