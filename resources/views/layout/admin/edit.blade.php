@extends('layout.app')
@section('title')
<title>Admin Dashboard</title>
@endsection 

@section('content')
<h1>Edit Product</h1>
<hr>
<form action="{{url('admin/product', [$product->id])}}" method="POST" enctype="multipart/form-data">
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
        @foreach ($images as $image)
            <div id="inputFormRow">
                <div class="input-group mb-3" style="margin-top:10px">
                    <div class="col-md-3">
                        <label for="image_name">Remove this image?</label>
                    </div>
                    <div class="col-md-3">
                        <input class="form-check-input-lg" type="checkbox" name="remove[]" value="{{ $image->id }}" id="flexCheckDefault" style="transform: scale(2);">
                    </div>
                    <img src="/images/{{ $image->image_source }}" alt="product_images" class="img-fluid" width="400" height="400"/>
                    <label for="image_name">{{ $image->original_name }}</label>
                    <!--<div class="input-group-append">               
                        <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                    </div>-->
                </div>
            </div>
        @endforeach
    </div>

    <div class="form-group mt-4">
            <div id="inputFormRow">
                <div class="input-group mb-3" style="margin-top:10px">
                    <input type="file" name="images[]" multiple class="form-control" accept="image/*">
                    <div class="input-group-append">                
                        <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                    </div>
                </div>
            </div>

        <div id="newRow"></div>
        <button id="addRow" type="button" class="btn btn-info">Add Image</button>
    </div>

    <div class="form-group">
        <label for="category">Product category</label>
        <select name="categorySelect" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
            <option value="{{ $product_categories->first()->id ?? '-' }}" selected>{{ $product_categories->first()->name ?? '-' }}</option>
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
    <button type="submit" class="btn btn-primary">Edit</button>
</form>

<script type="text/javascript">
    // add row
    $("#addRow").click(function () {
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '<input type="file" name="images[]" multiple accept="image/*" class="form-control m-input">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });
</script>
@endsection
