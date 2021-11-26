@extends('layout.app')
@section('content')

@if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
	<h1>List of your products</h1>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
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
                <!--<td><img src="H.gif" alt="" height=100 width=100></img></td>            pato potrebujeme sem najak dostat obrazek je v produt-card :)--> 

                <td>{{$product->description}}</td>
                <td>{{$product->created_at->toFormattedDateString()}}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a class="btn btn-warning" href="{{ URL::to('admin/product/' . $product->id . '/edit') }}">
                            Editovať
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

    <a class="btn btn-primary" href="/admin/product/create" role="button">New product</a>

@endsection