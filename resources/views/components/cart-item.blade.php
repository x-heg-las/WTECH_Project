<li class="cart-item row">
    <div class="image-wrapper col-sm-2">
        <img src="images/{{$thumbnail()}}" class="img-fluid align-middle" alt="product">
    </div>
    <div class="product-wrapper col-8 container-fluid d-flex align-item-begin align-content-start">
        <div class="product-description row mb-auto">
            <a href="/products/{{$product->id}}"><p>{{ $product->name }}</p></a>
        </div>
        @auth
        <form class="product-meta row " action="{{url('remove_item_customer', [$item, $item->product_id])}}" method="POST">
        @endauth
        @guest
        <form class="product-meta row " action="{{url('remove_item', [$item->product_id])}}" method="POST">
        @endguest
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <ul>
                <li><button typpe="submit" class="btn"><span class="fa fa-times-circle" aria-hidden="true">Remove</span></button></li>
                <li><span class="pricetag">$ {{ $item->total_price }}</span></li>
            </ul>
    </form>
    </div>
    <div class="product-quantity-wrapper col-2">
        <livewire:counter quantity="{{ $item->quantity }}" item="{{ $item->id }}" productID="{{ $item->product_id }}"/>
    </div>
</li>