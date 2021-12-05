@extends('layout.app')
@section('content')

@if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
	<h1>List of your products</h1>
    <a class="btn btn-primary purple-btn" href="/admin/product/create" role="button">New product</a>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Thumbnail</th>
                <th scope="col">Description</th>
                <th scope="col">Date of creation</th>
                <th scope="col">Options</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <th scope="row">{{$product->id}}</th>
                <td><a href="/products/{{$product->id}}">{{$product->name}}</a></td>
                @if($product->images()->first())
                <td><img src="{{ url('images/'.$product->images()->first()->image_source)}}" alt="NONE" width="100" height="100"></td>
                @else
                <td><img src="" alt="NONE" width="100" height="100"></td>
                @endif
                <td>{{$product->description}}</td>
                <td>{{$product->created_at->toFormattedDateString()}}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a class="btn btn-warning" href="{{ URL::to('admin/product/' . $product->id . '/edit') }}">
                            Edit
                        </a>&nbsp;&nbsp;
                        <form action="{{url('admin/product', [$product->id])}}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-danger" value="Delete"/>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

  

@endsection