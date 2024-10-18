@extends('layouts.master')
@section('title')
Create Product
@endsection

@section('content')
<h1>Create</h1>

<a href="{{ route('products.index') }}" class="btn btn-success">back</a>


<form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" />

        @error('name')
        <span class="text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Description</label>
        <input type="text" class="form-control" name="description" />

        @error('description')
        <span class="text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Price</label>
        <input type="number" class="form-control" name="price" />

        @error('price')
        <span class="text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Quantity</label>
        <input type="number" class="form-control" name="quantity" />

        @error('quantity')
        <span class="text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Is_active</label>
        <input class="form-check-input" type="checkbox" value="1" name="is_active" checked />

        @error('is_active')
        <span class="text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Image</label>
        <input type="file" class="form-control" name="image" />

        @error('name')
        <span class="text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>

    <div class="mb-3">
        <button class="btn btn-info">Submit</button>
    </div>


</form>

@endsection
