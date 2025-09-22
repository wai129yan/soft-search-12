@extends('layouts.layout')
@section('content')

    <div class="container mt-2">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0 font-weight-bold">Product Details</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> {{ $products->name }}</p>
                        <p><strong>Description:</strong> {{ $products->description }}</p>
                        <p><strong>Price:</strong> ${{ number_format($products->price, 2) }}</p>
                        <p><strong>Quantity:</strong> {{ $products->quantity }}</p>
                        <p><strong>Status:</strong>
                            <span class="badge {{ $products->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($products->status) }}
                            </span>
                        </p>
                        <p><strong>Category:</strong> {{ $products->category ? $products->category->name : 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        @if($products->image)
                            <div class="text-center">
                                <img src="{{ asset('storage/' . $products->image) }}"
                                     alt="{{ $products->name }}"
                                     class="img-fluid rounded"
                                     style="max-width: 300px;">
                            </div>
                        @else
                            <div class="text-center">
                                <p class="text-muted">No image available</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="m-2">
            <a href="{{ route('product.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="" class="btn btn-primary">Edit</a>
        </div>
    </div>
@endsection
