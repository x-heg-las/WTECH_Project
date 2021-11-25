@extends('layout.app')
 
@section('content')
<h1>Editácia úlohy</h1>
<hr>
<form action="{{url('admin/product', [$product->id])}}" method="POST">
	<input type="hidden" name="_method" value="PUT">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Product name</label>
        <input type="text" value="{{$product->name}}" class="form-control" id="productName"  name="name" >
    </div>
    <div class="form-group">
        <label for="description">Product description</label>
        <textarea class="form-control" id="productDescription" name="description" >{{$product->description}}</textarea>
    </div>

    <div class="form-group">
        <label for="price">Product price</label>
        <input type="number" step="0.01" id="productPrice" value="{{$product->price}}" class="form-control" name="price">
    </div>

    <div class="form-group">
        <label for="stock">Product stock</label>
        <input type="number" min="0" step="1" oninput="validity.valid||(value='');" id="productStock" value="{{$product->stock}}" class="form-control" name="stock">
    </div>

    <div class="form-group">
        <label for="category">Product category</label>
        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
            <option selected>Category</option>
            @foreach ($categories as $category)
               <option value="{{$category->name}}">{{$category->name}}</option>
            @endforeach
        </select>
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
    <button type="submit" class="btn btn-primary">Edit</button>
</form>
@endsection
