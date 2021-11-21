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
            @if(Auth::user())
                <div class="form-group">
                    <label for="fullName">First name:</label>
                    <input type="text" id="fullName" placeholder="First name" value="{{$customer->first_name}}"  class="form-control" name="first_name">
                </div>
                <div class="form-group">
                    <label for="streetAndNumber">Last name:</label>
                    <input type="text" id="lastName" placeholder="Last name" value="{{$customer->last_name}}" class="form-control" name="last_name">
                </div>

                @if($address != null)
                    <div class="form-group">
                        <label for="streetAndNumber">Street and number:</label>
                        <input type="text" id="streetAndNumber" placeholder="Street and Number" value="{{$address->street_and_number}}" class="form-control" name="street_and_number" required="required">
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" id="city" placeholder="City" class="form-control" value="{{$address->city}}" name="city" required="required"> 
                    </div>
                    <div class="form-group">
                        <label for="zipCode">Zip code:</label>
                        <input type="text" id="zipCode" placeholder="Zip Code" class="form-control" value="{{$address->zip_code}}" name="zip_code" required="required">
                    </div>
                    <div class="form-group">
                        <label for="zipCode">Country:</label>
                        <input type="text" id="country" placeholder="Country" class="form-control" value="{{$address->country}}" name="country" required="required">
                    </div>
                @else
                    <div class="form-group">
                        <label for="streetAndNumber">Street and number:</label>
                        <input type="text" id="streetAndNumber" placeholder="Street and Number" class="form-control" name="street_and_number" required="required">
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" id="city" placeholder="City" class="form-control" name="city" required="required"> 
                    </div>
                    <div class="form-group">
                        <label for="zipCode">Zip code:</label>
                        <input type="text" id="zipCode" placeholder="Zip Code" class="form-control" name="zip_code" required="required">
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">Country:</label> 
                        <input type="text" id="country" placeholder="Country" class="form-control" name="country">
                    </div>
                @endif
                
                <div class="form-group">
                    <label for="phoneNumber">Phone number:</label> 
                    <input type="text" id="phoneNumber" placeholder="Phone number" value="{{$customer->telephone}}" class="form-control" name="telephone">
                </div>
                <div class="form-group">
                    <label for="email">Mail:</label>
                    <input type="email" id="email" placeholder="Mail" value="{{$customer->email}}" class="form-control" name="email" required="required">
                </div>
            @else
                <div class="form-group">
                    <label for="fullName">First name:</label>
                    <input type="text" id="fullName" placeholder="First name" class="form-control" name="first_name" required="required">
                </div>
                <div class="form-group">
                    <label for="streetAndNumber">Last name:</label>
                    <input type="text" id="lastName" placeholder="Last name" class="form-control" name="last_name" required="required">
                </div>
                <div class="form-group">
                    <label for="streetAndNumber">Street and number:</label>
                    <input type="text" id="streetAndNumber" placeholder="Street and Number" class="form-control" name="street_and_number" required="required">
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" id="city" placeholder="City" class="form-control" name="city" required="required"> 
                </div>
                <div class="form-group">
                    <label for="zipCode">Zip code:</label>
                    <input type="text" id="zipCode" placeholder="Zip Code" class="form-control" name="zip_code" required="required">
                </div>
                <div class="form-group">
                    <label for="phoneNumber">Country:</label> 
                    <input type="text" id="country" placeholder="Country" class="form-control" name="country">
                </div>
                <div class="form-group">
                    <label for="phoneNumber">Phone number:</label> 
                    <input type="text" id="phoneNumber" placeholder="Phone number" class="form-control" name="telephone">
                </div>
                <div class="form-group">
                    <label for="email">Mail:</label>
                    <input type="email" id="email" placeholder="Mail" class="form-control" name="email" required="required">
                </div>
            @endif
        </div>
    </div>  
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="d-flex justify-content-between mt-5" id="checkoutNavigation">
    <a href="{{ url('/shopping_cart') }}" role="button" class="w-25 btn btn-dark btn-lg">Back</a>
    <button type="submit" class="w-25 purple-btn btn btn-dark btn-lg">Next step</button>
</div>
</form>
@endsection