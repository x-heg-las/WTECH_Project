@extends('layout.app')

@section('content')
        <div class="container">
            <div class="row py-5">
                <div class="col-12 col-md-6 col-lg-6">
                    <!-- image -->
                
                    @if(count($gallery) >= 1)
                <img src="{{ URL::to('/') }}/images/{{ $gallery->first()->image_source }}" alt="Arduino" class="img-fluid" />
            @else
            <img src="s" alt="No available image" class="img-fluid" />
            @endif
         
           
                    <div class="row py-3">
                        <i class="col-lg-1 offset-lg-1 fas fa-caret-left arrow d-none d-lg-grid"></i>
                        <div class="col-lg-2 d-none d-lg-grid">
                            <img src="http://placehold.it/100x100" class="img-fluid" alt="placeholder" />
                        </div>
                        <div class="col-lg-2 d-none d-lg-grid">
                            <img src="http://placehold.it/100x100" class="img-fluid" alt="placeholder" />
                        </div>
                        <div class="col-lg-2 d-none d-lg-grid">
                            <img src="http://placehold.it/100x100" class="img-fluid" alt="placeholder" />
                        </div>
                        <div class="col-lg-2 d-none d-lg-grid">
                            <img src="http://placehold.it/100x100" class="img-fluid" alt="placeholder" />
                        </div>
                        <i class="col-lg-1 fas fa-caret-right arrow d-none d-lg-grid"></i>
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
                            <form  method="PUT" class="d-grid col-md-7">
                                <a href="{{url('products/'.$request->route('product'))}}" role="button" class="btn btn-success btn-lg">Buy</a>
                            </form>
                        <div class="col-md-5">
                            <button type="button" class="btn btn-lg btn-full-width btn-secondary big-button">Add to
                                wishlist</button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row py-5">
                <div class="col-md-8">
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

                <div class="col-md-3 offset-md-1">
                    <div class="row">
                        <h1 class="display-6">Recommended</h1>
                    </div>
                    <div class="row">

                        <div class="card product-card">
                            <a href="#">
                                <img src="img/electronics_arduino_diy.png" alt="Arduino" class="img-fluid" />
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

                        <div class="card product-card">
                            <a href="#">
                                <img src="img/electronics_arduino_diy.png" alt="Arduino" class="img-fluid" />
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

                        <div class="card product-card">
                            <a href="#">
                                <img src="img/electronics_arduino_diy.png" alt="Arduino" class="img-fluid" />
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

                <div class="row text-center py-3">
                    <h1 class="display-6">Recently viewed</h1>
                </div>

                <div class="row  px-0 flex-d">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 d-flex align-items-stretch">
                        <div class="card product-card">
                            <a href="#">
                                <img src="img/electronics_arduino_diy.png" alt="Arduino" class="img-fluid" />
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

                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 d-flex align-items-stretch">
                        <div class="card product-card">
                            <a href="#">
                                <img src="img/electronics_arduino_diy.png" alt="Arduino" class="img-fluid" />
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

                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 d-flex align-items-stretch">
                        <div class="card product-card">
                            <a href="#">
                                <img src="img/electronics_arduino_diy.png" alt="Arduino" class="img-fluid" />
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

                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 d-flex align-items-stretch">
                        <div class="card product-card">
                            <a href="#">
                                <img src="img/electronics_arduino_diy.png" alt="Arduino" class="img-fluid" />
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
@endsection