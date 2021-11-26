@extends('layout.app')
 
@section('content')
<h1>Nová úloha</h1>
<hr>
<form action="/admin/product" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Product name</label>
        <input type="text" class="form-control" id="productName"  name="name" >
    </div>
    <div class="form-group">
        <label for="description">Product description</label>
        <textarea class="form-control" id="productDescription" name="description" ></textarea>
    </div>

    <div class="form-group">
        <label for="price">Product price</label>
        <input type="number" step="0.01" id="productPrice" class="form-control" name="price">
    </div>

    <div class="form-group">
        <label for="stock">Product stock</label>
        <input type="number" min="0" step="1" oninput="validity.valid||(value='');" id="productStock" class="form-control" name="stock">
    </div>

    <div class="form-group">
        <label for="category">Product category</label>
        <select name='category' class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
            <option value="empty" selected>Category</option>
            @foreach ($categories as $category)
               <option value="{{$category->id}}">{{$category->name}}</option>
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
    <button type="submit" class="btn btn-primary">Vytvoriť</button>
</form>
@endsection
