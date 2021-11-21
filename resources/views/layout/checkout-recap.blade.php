@extends('layout.app')

@section('title')
<title>Order recapitulation</title>
@endsection

@section('content')
<div class="row">
    <h1 class="display-5">Order recapitulation</h1>
</div>
<section class="my-4">
    <h3>Shipping details</h3>
    <div class="row ">
        <div class="col-3">
            <span class="d-block text-truncate">Full name:</span>
        </div>
        <div class="col-9 ">
        <p class="text-wrap text-break">{{ $customer->first_name }} {{ $customer->last_name }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <span class="d-block text-truncate">Street and number:</span>
        </div>
        <div class="col-9">
            <p class="text-wrap text-break">{{ $customer->address()->get()->first()->street_and_number }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <span class="d-block text-truncate">City:</span>
        </div>
        <div class="col-9">
            <p class="text-wrap text-break">{{ $customer->address()->get()->first()->city }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <span class="d-block text-truncate">Zip code:</span>
        </div>
        <div class="col-9">
            <p class="text-wrap text-break">{{ $customer->address()->get()->first()->zip_code }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <span class="d-block text-truncate">Phone number:</span>
        </div>
        <div class="col-9">
            <p class="text-wrap text-break">{{ $customer->telephone }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <span class="d-block text-truncate">Email:</span>
        </div>
        <div class="col-9">
            <p class="text-wrap text-break">{{ $customer->email }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <span class="d-block text-truncate">Shipping:</span>
        </div>
        <div class="col-9">
            <p class="text-wrap text-break">{{ $shipping }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <span class="d-block text-truncate">Payment method:</span>
        </div>
        <div class="col-9">
            <p class="text-wrap text-break">{{ $payment }}</p>
        </div>
    </div>
</section>
<section class="my-4">
    <h3>Order detail</h3>
    <div class="row">
        <div class="col-8">
            <span>Product name</span>
        </div>
        <div class="col-2">
            <span>Unit cost</span>
        </div>
        <div class="col-2">
            <span>Total cost</span>
        </div>
        <hr>
    </div>
    @foreach($items as $item)
    <div class="row my-2">
        <div class="col-6">{{ $item->product()->get()->first()->name }}</div>
        <div class="col-2">Product type</div>
        <div class="col-2">{{ $item->unit_price }} $</div>
        <div class="col-2">{{ $item->total_price }} $</div>
    </div>
    @endforeach
    <div class="row border-top">
        <hr>
        <div class="col-2">
            <span>Total</span>
        </div>
        <div class="col-2 offset-8">
            <span>{{ $sum }} $</span>
        </div>
    </div>
    <div class="row">
        
    </div>
</section>
<div class="row flex-d justify-content-between">
    <div class="col-sm-3 form-check d-flex flex-fill w-100 w-sm-auto">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">I agree with the terms and conditions</label>
    </div>
    <div class="col-sm-3 d-flex flex-fill">
        <a href="payment_information.html" role="button" class="btn btn-dark btn-lg w-100 w-sm-auto">Back</a>
    </div>
    <div class="col-sm-3 d-flex flex-fill ">
        <a href="#" role="button" class=" btn purple-btn btn-lg w-100 w-sm-auto">Confirm order</a>
    </div>
</div>
@endsection