@extends('layout.app')

@section('title')
<title>PiStore</title>
@endsection

@section('content')
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <div class="row justify-content-between">
        <!-- card-->
        <div class="col-sm d-flex">
            <a href="/search?category[]=Powering" role="button" class="d-flex flex-fill">
            <div class="card inactive-btn d-flex flex-fill">
                <div class="card-body text-center">
                <i class="fas fa-bolt"></i>
                <span>Power supplies</span>
                </div>
            </div>
            </a>
        </div>
        <!-- card-->
        <div class="col-sm d-flex">
            <a href="/search?category[]=Modules" class="d-flex flex-fill">
            <div class="card inactive-btn d-flex flex-fill">
                <div class="card-body text-center">
                <i class="fas fa-shield-alt"></i>
                <span>Shield modules</span>
                </div>
            </div>
            </a>
        </div>
        <!-- card-->
        <div class="col-sm d-flex">
            <a href="#" role="button" class="d-flex flex-fill" data-bs-toggle="collapse" data-bs-target="#allCategories" aria-expanded="false" aria-controls="allCategories">
            <div class="card inactive-btn d-flex flex-fill">
                <div class="card-body text-center">
                    <i class="fas fa-chevron-circle-down"></i>
                    <span>All categories</span>
                </div>
            </div>
            </a>
        </div>
    </div>
    <div class="row py-3">
        <div class="col-12">
            <div class="collapse " id="allCategories">
                <div class="card card-body container-fluid" >
                    <ul class="list-group categories-group list-group-horizontal-m ">
                    @forelse($categories as $category)
                        <li class="list-group-item"><a href="/search?category[]={{ $category->name }}">{{ $category->name }}</a></li>
                    @empty
                        <li class="list-group-item">No category yet</li>
                    @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section>
        <h1 class="text-center">Popular categories</h1>
        <div class="row pt-3">
            <div class="col-sm d-flex">
            <a href="/search?category[]=Arduino" class="d-flex flex-fill">
                <div class="card flex-fill">
                    <div class="card-body category-card bg-info bg-gradient">
                        <article>
                            <h2 class="text-center">Arduino</h2>
                        </article>
                    </div>
                </div>
            </a>
            </div>
            <div class="col-sm d-flex">
            <a href="/search?category[]=ESP32" class="d-flex flex-fill">
                <div class="card bg-secondary bg-gradient flex-fill">
                <div class="card-body category-card">
                    <article>
                    <h2 class="text-center">ESP32</h2>
                    </article>
                </div>
                </div>
            </a>
            </div>
            <div class="col-sm d-flex">
            <a href="/search?category[]=Raspberry_Pi" class="d-flex flex-fill">
                <div class="card category-card bg-danger bg-gradient flex-fill">
                <div class="card-body">
                    <article>
                    <h2 class="text-center">Raspberry PI</h2>
                    </article>
                </div>
                </div>
            </a>
            </div>
        </div>
        <div class="row py-sm-3">
            <div class="col-sm container-fluid d-none d-lg-grid">
            <div class="row">
                <div class="col-sm d-flex">
                    <a href="/search?category[]=Displays" class="d-flex flex-fill">
                        <div class="card d-flex flex-fill" id="card_1">
                            <div class="card-body category-card">
                                <article>
                                    <h2 class="text-center">Displays</h2>
                                </article>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-sm d-flex">
                    <a href="/search?category[]=DIY" class="d-flex flex-fill">
                        <div class="card d-flex flex-fill" id="card_2">
                            <div class="card-body category-card">
                                <article>
                                    <h2 class="text-center">DIY Kits</h2>
                                </article>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm d-flex">
                    <a href="/search?category[]=Sensors" class="d-flex flex-fill">
                        <div class="card d-flex flex-fill" id="card_3">
                            <div class="card-body category-card">
                                <article>
                                    <h2 class="text-center">Sensors</h2>
                                </article>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            </div>
            <div class="col-sm container-fluid ">
                <a href="/search?category[]=SALE">
                    <div class="card" id="card_sale">
                        <div class="card-body category-card text-center">
                            <article>
                                <h2>Sale</h2>
                                <i class="fas fa-dollar-sign fa-10x d-none d-sm-block"></i>
                            </article>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
    <section>
            <h2 class="text-center">New products</h2>
            <div class="row">
                @foreach ($new as $product)
                    <x-product-card :product="$product"/>
                @endforeach
            </div>
    </section>
    <section>
            <h2 class="text-center">Sale</h2>
            <div class="row">
                @foreach ($sale as $product)
                    <x-product-card :product="$product"/>
                @endforeach
            </div>
    </section>
@endsection