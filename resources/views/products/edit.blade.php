<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.layout')
@section('title', 'Product edit use include Page')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h1 class="text-center">Edit Product</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('products.update', [ 'id' => $product->id])}}" method="post">
            @csrf
            <div class="row mb-3">
                <div class="col-sm-6">
                    <label class="d-block" for="">Name</label>
                    <input name='name' value="{{old('name') ?? $product->name }}" class="form-control" type="text" placeholder="Enter name..." />
                </div>
                <div class="col-sm-6">
                    <label class="d-block" for="">Description</label>
                    <input name='description' value="{{old('description') ?? $product->description}}" class="form-control" type="text" placeholder="Enter description..." />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-6">
                    <label class="d-block" for="">Price</label>
                    <input type="number" name='price' value="{{old('price') ?? $product->price}}" class="form-control" type="text" placeholder="Enter price..." />
                </div>
                <div class="col-sm-6">
                    <label class="d-block" for="">Category</label>
                    <select name='category_id' class="form-select">
                        @foreach ($categories as $cate)
                        <option {{ $cate->id == $product->category_id ? 'selected' : '' }} value="{{ $cate->id}}">{{ $cate->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <button class="btn btn-primary col-2 mx-2">Update</button>
                <a class="btn btn-dark col-2" href="{{ route('products.index')}}" class="col-2">Cancel</a>
            </div>
        </form>

    </div>
</div>
@endsection