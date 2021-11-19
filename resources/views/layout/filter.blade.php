@extends('layout.app')

@section('content')
    <div class="container-xxl px-4 px-xl-4 px-xxl-0">

      <div class="row">
        <div class="col-12 col-md-6">
          <h1 class="display-5">Filtered result</h1>
        </div>

        <div class="col-12 col-md-6 pt-3">
          <div class="dropdown d-flex justify-content-lg-end">
            <button class="btn purple-btn dropdown-toggle" type="button" id="dropdownMenuButton1"
              data-bs-toggle="dropdown" aria-expanded="false">
              Sort by
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="#">Newest</a></li>
              <li><a class="dropdown-item" href="#">Lowest price</a></li>
              <li><a class="dropdown-item" href="#">Highest price</a></li>
            </ul>
          </div>
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="summary-wrapper col-12 col-md-4 col-lg-3">
          <div class="checkout-wrapper shadow row">
            <span class="display-5 row">Options</span>

            <div class="brand py-3">
              <button class="btn purple-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
                aria-expanded="false" aria-controls="collapseExample">
                Brands
              </button>

              <hr>

              <div class="collapse" id="collapseExample">
                <div class="radio-button">
                  <input type="radio" id="pi">
                  <label for="pi">Raspberry Pi</label>
                </div>

                <div class="radio-button">
                  <input type="radio" id="ard">
                  <label for="ard">Arduino</label>
                </div>

                <div class="radio-button">
                  <input type="radio" id="esp">
                  <label for="esp">ESP32</label>
                </div>
              </div>
            </div>

            <div class="memory">
              <button class="btn purple-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMemory"
                aria-expanded="false" aria-controls="collapseExample">
                Memory
              </button>

              <hr>

              <div class="collapse" id="collapseMemory">
                <div class="radio-button">
                  <input type="radio" id="1gb">
                  <label for="1gb">1 GB</label>
                </div>

                <div class="radio-button">
                  <input type="radio" id="2gb">
                  <label for="2gb">2 GB</label>
                </div>

                <div class="radio-button">
                  <input type="radio" id="4gb">
                  <label for="4gb">4 GB</label>
                </div>

                <div class="radio-button">
                  <input type="radio" id="8gb">
                  <label for="8gb">8 GB</label>
                </div>
              </div>
            </div>

            <div class="storage py-3">
              <button class="btn purple-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseStorage"
                aria-expanded="false" aria-controls="collapseExample">
                Storage
              </button>

              <hr>

              <div class="collapse" id="collapseStorage">
                <div class="radio-button">
                  <input type="radio" id="8-storage">
                  <label for="8-storage">8 GB</label>
                </div>

                <div class="radio-button">
                  <input type="radio" id="16-storage">
                  <label for="16-storage">16 GB</label>
                </div>

                <div class="radio-button">
                  <input type="radio" id="32-storage">
                  <label for="32-storage">32 GB</label>
                </div>
              </div>
            </div>

            <span class="fs-6 text-center">Lowest and highest price</span>

            <div class="input-group">
              <input type="number" aria-label="Lowest price" class="form-control">
              <input type="number" aria-label="Highest price" class="form-control">
            </div>
          </div>
        </div>

        <div class="col-0 col-md-6 col-lg-9 pr-lg-5">

          <div class="row  px-0 flex-d">
          @if($products->isNotEmpty())
            @foreach ($products as $product)
                <div class="post-list">
                    <p>{{ $product->name }}</p>
                    <p>{{ $product->description}}</p>
                </div>
            @endforeach
          @else 
              <div>
                  <h2>No $products found</h2>
              </div>
          @endif
          </div>
        </div>

      <!-- Pagination -->
      <div class="row py-5">
        <hr>
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center">
              {{ $products->links() }}
          </ul>
        </nav>
      </div>
    </div>
@endsection