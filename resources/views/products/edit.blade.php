@extends('layouts.app')

@section('title','Edit Product')

@section('content')
<h1>Edit Product</h1>

<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Name:</label>
    <input type="text" name="name" value="{{ old('name', $product->name) }}">
    @error('name') <span style="color:red">{{ $message }}</span> @enderror
    <br>

    <label>Category ID:</label>
    <input type="number" name="category_id" value="{{ old('category_id', $product->category_id) }}">
    @error('category_id') <span style="color:red">{{ $message }}</span> @enderror
    <br>

    <label>Price:</label>
    <input type="text" name="price" value="{{ old('price', $product->price) }}">
    @error('price') <span style="color:red">{{ $message }}</span> @enderror
    <br>

    <label>Quantity:</label>
    <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}">
    @error('quantity') <span style="color:red">{{ $message }}</span> @enderror
    <br>

    <label>Image:</label>
    <input type="file" name="image">
    @if($product->image)
        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" width="50">
    @endif
    <br><br>

    <button type="submit">Update Product</button>
</form>
@endsection
