@section('title')
<title>Dashboard</title>
@endsection
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>

    <div class="col-0 col-md-6 col-lg-9 pr-lg-5">

          <div class="row  px-0 flex-d">
          @if($products->isNotEmpty())
            @foreach ($products as $product)
              <x-product-card :product="$product"/>
            @endforeach
          @else 
              <div>
                  <h2>No $products found</h2>
              </div>
          @endif
          </div>
        </div>

    
</x-app-layout>
