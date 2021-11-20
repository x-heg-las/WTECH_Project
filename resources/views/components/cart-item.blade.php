<li class="cart-item row">
    <div class="image-wrapper col-sm-2">
        <img src="img/raspberry_pi.png" class="img-fluid align-middle" alt="product">
    </div>
    <div class="product-wrapper col-8 container-fluid d-flex align-item-begin align-content-start">
        <div class="product-description row mb-auto">
            <a href="#"><p>{{ $product->name }}</p></a>
        </div>
        <div class="product-meta row ">
            <ul>
                <li><a href="#"><span class="fa fa-times-circle" aria-hidden="true">Remove</span></a></li>
                <li><span class="pricetag">{{ $item->total_price }}</span></li>
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