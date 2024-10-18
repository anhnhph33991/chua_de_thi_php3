@extends('layouts.master')
@section('title')
List Product
@endsection

@section('content')
<h1>List</h1>
<a href="{{ route('products.create') }}" class="btn btn-success">Create</a>

<div class="table-responsive">
    <table class="table table-primary">
        <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Is_Active</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr class="">
                <td scope="row">
                    {{-- Nếu có ảnh và tồn tại trong storage mới render --}}
                    @if($product->image && Storage::exists($product->image))
                    <img src="{{ Storage::url($product->image) }}" alt="" width="50px" height="50px">
                    @endif
                </td>
                <td>
                    {{ $product->name }}
                </td>
                <td>
                    {{ $product->description }}
                </td>
                <td>
                    {{ $product->price }}
                </td>
                <td>
                    {{ $product->quantity }}
                </td>
                <td>
                    <span class="badge {{ $product->name ? "bg-success" : "bg-danger" }}">
                        {{ $product->name ? "Active" : "No Active" }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
</div>


@endsection
