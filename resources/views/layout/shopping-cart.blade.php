@extends('layout.app')

@section('title')
<title>Shopping Cart</title>
@endsection

@section('content')
<div class="container-xxl ">
<div class="row">
    <h1 class="display-5">Shopping cart</h1>
</div>
<div class="row">
    <div class="col-lg-9 pr-lg-5 shopping-container">
        <ul class="shopping-cart">
            <li class="cart-item row">
                <div class="image-wrapper col-sm-2">
                    <img src="img/raspberry_pi.png" class="img-fluid align-middle" alt="prod">
                </div>
                <div class="product-wrapper col-8 container-fluid d-flex align-item-begin align-content-start">
                    <div class="product-description row mb-auto">
                        <a href="#"><p>Product name</p></a>
                    </div>
                    <div class="product-meta row ">
                        <ul>
                            <li><a href="#"><span class="fa fa-times-circle" aria-hidden="true">Remove</span></a></li>
                            <li><span class="pricetag">123,4$</span></li>
                        </ul>
                    </div>
                </div>
                <div class="product-quantity-wrapper col-2">
                    <div class="dropdown">
                        <a class="btn dropdown-toggle dropdown-quantity" href="#" data-bs-toggle="dropdown" >1</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item">2</a></li>
                            <li><a class="dropdown-item">3</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="cart-item row">
                <div class="image-wrapper col-sm-2">
                    <img src="img/led_detail.png" class="img-fluid align-middle" alt="prod">
                </div>
                <div class="product-wrapper col-8 container-fluid d-flex align-item-begin align-content-start">
                    <div class="product-description row mb-auto">
                        <a href="#"><p>Product NamLorem ipsum dolor sit amet, consectetur . Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ac massa et mi mattis elementum dignissim eu nunc. Aliquam nulla sem, bibendum eu ullamcorper mollis, consectetur eget mauris. Praesent eu tincidunt sapien. Cras efficitur lorem felis. Vivamus nec sem non lorem posuere mattis et non est. Quisque felis mi, lacinia ac pellene</p></a>
                    </div>
                    <div class="product-meta row ">
                        <ul>
                            <li><a href="#"><span class="fa fa-times-circle" aria-hidden="true">Remove</span></a></li>
                            <li><span class="pricetag">123,4$</span></li>
                        </ul>
                    </div>
                </div>
                <div class="product-quantity-wrapper col-2">
                    <div class="dropdown">
                        <a class="btn dropdown-toggle dropdown-quantity" href="#" data-bs-toggle="dropdown" >1</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item">2</a></li>
                            <li><a class="dropdown-item">3</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="summary-wrapper col-lg-3">
        <div class="checkout-wrapper shadow row">
            <span class="display-5 row">Summary</span>
            <div class="checkout">
                <div class="d-flex justify-content-center">
                    <i class=" my-2 fas fa-shopping-cart fa-9x d-none d-lg-inline"></i>
                </div>
            </div>
            <div class="mt-3 d-flex flex-column justify-content-center text-center">
                <button id="continue-shopping" type="button" class="btn btn-dark mt-3">Continue shopping</button> 
                <span class="mt-3 fs-4 fw-bold">Total: 129$</span>
                <a href="shipping_information.html" role="button" class="mt-3 btn btn-dark purple-btn">Checkout</a>
            </div>
        </div>
        <div class="row pay-options">
            <div>
                <span class="display-6">Payment options</span>
            </div>
            <div class="row mt-3">
                <a href="#"><i id="paypal" class="fab fa-cc-paypal fa-5x"></i></a>
            </div>
            <div class="row mt-3">
                <a href="#"><i class="far fa-credit-card fa-5x"></i></a>
            </div>
            <div class="row mt-3">
                <a href="#"><i id="banknote" class="fas fa-money-bill-alt fa-4x"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection