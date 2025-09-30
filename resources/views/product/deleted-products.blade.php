@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h2>Product List</h2>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-md-6">
                                <form class="d-flex" role="search" action="{{ route('product.trash') }}" method="GET">
                                    @csrf
                                    <input class="form-control me-2" name="search" type="search" placeholder="Search"
                                        aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('product.index') }}" class="float-end btn btn-warning">View All
                                    Products</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @if (Session::has('success'))
                <span class="alert alert-success p-2">{{ Session::get('success') }}</span>
            @endif
            @if (Session::has('error'))
                <span>{{ Session::get('error') }}</span>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    <strong>{{ $product->name }}</strong><br>
                                </td>
                                <td>{{ Str::limit($product->description, 50) }}</td>
                                <td>{{ $product->category->name ?? '-' }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>
                                    <span class="badge {{ $product->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($product->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" width="40" height="40"
                                            style="object-fit: cover;" alt="Product Image">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('product.show', $product->id) }}"
                                        class="btn btn-sm btn-outline-info">View</a>
                                    <form action="{{ route('product.restore', $product->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Restore this product?')">
                                        @csrf @method('POST')
                                        <button class="btn btn-sm btn-outline-info">Restore</button>
                                    </form>
                                    <form action="{{ route('product.destroyParement', $product->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Delete this product permanently?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-5">
                                    No products found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
