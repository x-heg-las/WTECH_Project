@extends('layout.app')

@section('title')
<title>{{$product->name}}</title>
@endsection
@section('content')
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
        <div class="container">
            <div class="row py-5">
                <div class="col-12 col-md-6 col-lg-6">
                    <!-- image -->  
                    <div id="gallery" class="carousel slide carousel-dark" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @forelse($gallery as $image)
                                @if ($loop->first)
                                <div class="carousel-item active">
                                    <img src="{{ URL::to('/') }}/images/{{ $image->image_source }}" alt="Product image" class="mx-auto d-block w-100">
                                </div>
                                @else
                                <div class="carousel-item">
                                    <img src="{{ URL::to('/') }}/images/{{ $image->image_source }}" alt="Product image" class="mx-auto d-block w-100">
                                </div>
                                @endif
                            @empty
                                <div class="carousel-item">
                                    <img src="s" alt="No available image" class="img-fluid  w-100" />  
                                </div>
                            @endforelse
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#gallery" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#gallery" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <!-- description -->
                    <div class="row">
                        <div class="col-md-12">
                            <h1>{{ $product->name }}</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <p class="first-detail-description">
                                {{ $product->description }}
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 bottom-rule">
                            <h2 class="product-price">${{ $product->price }}</h2>
                        </div>
                    </div>
                    <div class="row">
                        <form  method="POST" class="d-grid col-md-7 form-inline" action="{{ URL::to('/') }}/products/{{ $request->route('product')->id }}">
                            <input name="_method" type="hidden" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="input-group">
                                <input type="submit" value="Buy" class="btn btn-success btn-lg col-12 col-sm-8 col-md-8"/>    
                                <input type='number' name='quantity' id="number" value=1 min="1" class="col-12 col-sm-4 col-md-4">
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
            <div class="row py-5">
                <div class="col-12">
                    <div class="row">
                        <ul class="nav nav-tabs">
                            <li class="nav-item col-md-4">
                                <a href="#home" class="nav-link active" data-bs-toggle="tab">Description</a>
                            </li>
                            <li class="nav-item col-md-4">
                                <a href="#profile" class="nav-link" data-bs-toggle="tab">Similar</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="home">
                                <p class="second-detail-description">
                                    {{ $product->description }}
                                </p>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <div class="row">
                                    <div class="col-md-4 offset-md-2">
                                        <div class="card product-card">
                                            <a href="#">
                                                <img src="img/electronics_arduino_diy.png" alt="Arduino"
                                                    class="img-fluid" />
                                            </a>
                                            <section>
                                                <div class="card-body">
                                                    <a href="#">
                                                        <h3 class="text-truncate">Product name</h3>
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    123 €
                                                </div>
                                            </section>
                                        </div>
                                    </div>

                                    <div class="col-md-4 offset-md-2">
                                        <div class="card product-card">
                                            <a href="#">
                                                <img src="img/electronics_arduino_diy.png" alt="Arduino"
                                                    class="img-fluid" />
                                            </a>
                                            <section>
                                                <div class="card-body">
                                                    <a href="#">
                                                        <h3 class="text-truncate">Product name</h3>
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    123 €
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 offset-md-2">
                                        <div class="card product-card">
                                            <a href="#">
                                                <img src="img/electronics_arduino_diy.png" alt="Arduino"
                                                    class="img-fluid" />
                                            </a>
                                            <section>
                                                <div class="card-body">
                                                    <a href="#">
                                                        <h3 class="text-truncate">Product name</h3>
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    123 €
                                                </div>
                                            </section>
                                        </div>
                                    </div>

                                    <div class="col-md-4 offset-md-2">
                                        <div class="card product-card">
                                            <a href="#">
                                                <img src="img/electronics_arduino_diy.png" alt="Arduino"
                                                    class="img-fluid" />
                                            </a>
                                            <section>
                                                <div class="card-body">
                                                    <a href="#">
                                                        <h3 class="text-truncate">Product name</h3>
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    123 €
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row py-5">
                        <div class="row">
                            <h1 class="display-6">Parameters</h1>
                        </div>
                        <table class="table" id="vertical-1">
                            
                        @foreach($parameters as $parameter)
                            @if($parameter->number != null)
                            <tr>
                                <th scope="row">{{$parameter->key}}</th>
                                <td>{{$parameter->text}}</td>
                                <td>{{$parameter->number}}</td>
                                <td>{{$parameter->units}}</td>
                            </tr>
                            @endif
                        @endforeach
                        </table>

                        <div class="row">
                            <div class="brand py-3">
                                <div class="text-center">
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseExample" aria-expanded="false"
                                        aria-controls="collapseExample">
                                        All parameters
                                    </button>
                                </div>

                                <div class="collapse py-3" id="collapseExample">
                                    <table class="table" id="vertical-2">
                                    @foreach($parameters as $parameter)
                                        @if($parameter->number == null)
                                        <tr>
                                            <th scope="row">{{$parameter->key}}</th>
                                            <td>{{$parameter->text}}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row text-center py-3">
                    <h1 class="display-6">Recently viewed</h1>
                </div>

                <div class="row  px-0 flex-d">
                @foreach($recent as $item)
                    <x-product-card :product="$item"/>
                @endforeach
                </div>
            </div>
        </div>
    <script>
        // Select your input element.
        var number = document.getElementById('number');

        // Listen for input event on numInput.
        number.onkeydown = function(e) {
            if(!((e.keyCode > 95 && e.keyCode < 106)
            || (e.keyCode > 47 && e.keyCode < 58) 
            || e.keyCode == 8)) {
                return false;
            }
        }
    </script>
@endsection