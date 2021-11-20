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
            @if($items ?? '')
                @foreach ($items ?? '' as $item)
                    <x-cart-item :item="$item"/>
                @endforeach
            @endif
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
                <a href="{{ url()->previous() }}" id="continue-shopping" role="button" class="btn btn-dark mt-3">Continue shopping</a> 
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