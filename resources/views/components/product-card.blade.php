<div class="col-12 col-sm-6 col-md-4 col-lg-3">
    <div class="card product-card text-center">
        <a href="#">
            // <img src="images/{{ $record->thumbnail()->image_source }}" alt="Arduino" class="img-fluid" />
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
