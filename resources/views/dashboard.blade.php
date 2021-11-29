<x-app-layout>
    <x-slot name="header">

        <!-- TODO nahrad nejak!!!!!!!!!!!!!!!!!!!!! -->

        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">


        <!-- Latest compiled and minified CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


        <!-- Font Awesome -->
        <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet">

        <!--Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}"> 

        <!--Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

                                                                                            <!-- TODO nahrad nejak!!!!!!!!!!!!!!!!!!!!! -->

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

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
