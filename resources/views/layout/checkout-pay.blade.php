@extends('layout.app')

@section('title')
<title>Payment information</title>
@endsection
@section('content')
<div class="row">
    <h1 class="display-5">Checkout</h1>
</div>
<div class="row shipping-bulletpoint">
    <div class="col-1 bulletpoint">
        <i class="far fa-check-circle fa-2x"></i>
    </div>
    <div class="col-11">
        <span class="display-6 "> Payment method</span>
    </div>
</div>
<div class="row">
    <div class="btn-toolbar mt-4 col-12" role="toolbar" id="btn-shipment-methods">
        <x-checkout-option name="payment" text="Credit Card" domain="payment" label="far fa-credit-card"/>
        <x-checkout-option name="payment" text="PayPal" domain="payment" label="fab fa-cc-paypal"/>
        <x-checkout-option name="payment" text="Bank Transfer" domain="payment" label="fas fa-university"/>
    </div>
    <div class="d-flex justify-content-between mt-5" id="checkoutNavigation">
        <div class="w-25">
            <a href="shipping_information.html" role="button" class="btn btn-dark btn-lg">Back</a>
        </div>
        <div class="w-25">
            <a href="order_recap.html" role="button" class="btn purple-btn btn-lg">Next step</a>
        </div>
    </div>
</div>
<div>
    <div class="row mt-5">
        <span class="display-5">Detail</span>
    </div>
    <div class="border-bottom">
        @foreach($items as $item)  
        <div class="row mt-5">
            <div class="col-12 col-sm-6">
                <span class="d-block text-truncate"></span>
            </div>    
            <div class="col-4 col-sm-2">
                <span class="d-inline-block">Qty: 1x</span>
            </div>
            <div class="col-4 col-sm-2"><span class="d-inline-block">Type: something</span></div>
            <div class="col-4 col-sm-2"><span class="d-inline-block">124.9€</span></div>
        </div>
        @endforeach
    </div>   
    <div class="row mt-5">
        <div class="col-6 col-sm-6">
            <span class="d-block text-truncate">Total</span>
        </div>    
        <div class="col-6 col-sm-2 offset-sm-4"><span class="d-inline-block">124.5€</span></div>
    </div>
</div>
@endsection