@extends('layout.app')
@section('title')
<title>Shipping information</title>
@endsection

@section('content')
<form action="/shipping" method="post">
<div class="row">
    <h1 class="display-5">Shipping</h1>
</div>
<div class="row shipping-bulletpoint">
    <div class="col-1 bulletpoint">
        <i class="far fa-check-circle fa-2x"></i>
    </div>
    <div class="col-11">
        <span class="display-6"> Shipping information</span>
    </div>
</div>
<div class="row">
    <div class="col-md-9">
        <div class="shipping-container container">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="fullName">First name:</label>
                <input type="text" id="fullName" placeholder="First name"  class="form-control" name="first_name">
            </div>
            <div class="form-group">
                <label for="streetAndNumber">Last name:</label>
                <input type="text" id="lastName" placeholder="Last name"  class="form-control" name="last_name">
            </div>
            <div class="form-group">
                <label for="streetAndNumber">Street and number:</label>
                <input type="text" id="streetAndNumber" placeholder="Street and Number"  class="form-control" name="street_and_number">
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" placeholder="City" class="form-control" name="city"> 
            </div>
            <div class="form-group">
                <label for="zipCode">Zip code:</label>
                <input type="text" id="zipCode" placeholder="Zip Code" class="form-control" name="zip_code">
            </div>
            <div class="form-group">
                <label for="phoneNumber">Phone number:</label> 
                <input type="text" id="phoneNumber" placeholder="Phone number" class="form-control" name="telephone">
            </div>
            <div class="form-group">
                <label for="email">Mail:</label>
                <input type="email" id="email" placeholder="Mail" class="form-control" name="email">
            </div>
        </div>
    </div>  
</div>
<div class="row shipping-bulletpoint">
    <div class="col-1 bulletpoint">
        <i class="far fa-check-circle fa-2x"></i>
    </div>
    <span class="col-11 display-6 " id="shipping"> Shipping method</span>
</div>
<div class="btn-toolbar mt-4" role="toolbar">
    <x-checkout-option name="shipping" text="Reserve in shop" domain="shipping" label="fas fa-store-alt fa-3x"/>
    <x-checkout-option name="shipping" text="Postal service" domain="shipping" label="far fa-envelope fa-3x"/>
    <x-checkout-option name="shipping" text="Standard delivery" domain="shipping" label="fas fa-truck fa-3x"/>
</div>
<div class="d-flex justify-content-between mt-5" id="checkoutNavigation">
    <a href="{{ url('/shopping_cart') }}" role="button" class="w-25 btn btn-dark btn-lg">Back</a>
    <button type="submit" class="w-25 purple-btn btn btn-dark btn-lg">Next step</button>
</div>
</form>
@endsection