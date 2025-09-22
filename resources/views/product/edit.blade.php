@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="card mb-3">
            <div class="card-header">
                <h1 class="mb-0">Edit Product</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name', $product->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select @error('category_id') is-invalid @enderror"
                            id="category_id" name="category_id">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)


