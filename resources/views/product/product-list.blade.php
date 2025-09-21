@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="card mb-3">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="mb-0">Product List</h1>
                    </div>
                    <div class="col text-end">
                        <div class="row">
                            <div class="col-md-8">
                                <form class="d-flex">
                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('product.create') }}" class="btn btn-primary">Add Product</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($products) > 0)
                        @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->status }}</td>
                                <td>{{ $product->description }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center text-danger fw-bold">No product found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
