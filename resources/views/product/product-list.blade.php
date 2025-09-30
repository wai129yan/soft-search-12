@extends('layouts.layout')

@section('title', 'Product List')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Product Inventory</h2>
            <div class="d-flex gap-2">
                {{-- Search Form --}}
                <form method="GET" action="{{ route('product.index') }}" class="d-flex">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-sm" name="search"
                            placeholder="Search products..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-secondary btn-sm">Search</button>
                    </div>
                </form>
                {{-- Search Form --}}
                <a href="{{ route('product.create') }}" class="btn btn-primary btn-md">Add Product</a>
                {{-- Show Deleted Button --}}
                <a href="{{ route('product.trash') }}" class="btn btn-warning btn-md text-white"
                    style="transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#e0a800'"
                    onmouseout="this.style.backgroundColor=''">View Deleted</a>
                {{-- Show Deleted Button --}}
            </div>
        </div>

        {{-- Alerts --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Product Table --}}
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name </th>
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
                                <a href="{{ route('product.edit', $product->id) }}"
                                    class="btn btn-sm btn-outline-warning">Edit</a>
                                <form method="POST" action="{{ route('product.destroy', $product->id) }}" class="d-inline"
                                    onsubmit="return confirm('Delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                No products found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($products->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted small">
                    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }}
                    results
                </div>
                <div>
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @endif
    </div>
@endsection
