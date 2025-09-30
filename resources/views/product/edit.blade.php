@extends('layouts.layout')

@section('title', 'Edit Product')

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
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $product->name) }}">
                            {{-- Laravel မှာ form submit ပြီး error တက်တဲ့အခါ user ဖြည့်ထားတဲ့အချက်တွေကို ပြန်ပြဖို့ old() ကိုသုံးတယ်။ --}}
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                            name="category_id">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                            name="price" value="{{ old('price', $product->price) }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                            name="quantity" value="{{ old('quantity', $product->quantity) }}">
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>

                        {{-- error message for status --}}
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            {{-- error message for status --}}

                            <option value="">Select Status</option>
                            {{-- check if status is active or inactive --}}
                            <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="in-active"
                                {{ old('status', $product->status) == 'in-active' ? 'selected' : '' }}>
                                Inactive
                            </option>
                            {{-- check if status is active or inactive --}}
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- Simple Image Upload --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        {{-- Current product image --}}
                        @if ($product->image)
                            <div class="mb-3">
                                <label class="form-label text-muted">Current Image:</label>
                                <div class="border rounded p-2 bg-light">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Current Product Image"
                                        class="img-thumbnail d-block mb-2" style="max-width: 200px; max-height: 200px;">
                                    <small class="text-muted">File: {{ $product->image }}</small>
                                </div>
                            </div>
                        @endif


                        {{-- File input for new image --}}
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                            name="image" accept="image/*">


                        <small class="form-text text-muted">
                            @if ($product->image)
                                Uploading a new file will replace the current image.
                            @else
                                Choose an image file to upload
                            @endif
                        </small>


                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror


                        {{-- Keep track of old image for backend --}}
                        <input type="hidden" name="old_image" value="{{ $product->image }}">


                        {{-- If a new file was uploaded but validation failed --}}
                        @if (old('image') && $errors->has('image'))
                            <div class="mt-3">
                                <label class="form-label text-danger">Previously Selected Image (with errors):</label>
                                <div class="border border-danger rounded p-2 bg-light">
                                    <small class="text-danger">File was selected but had validation errors</small><br>
                                    <small class="text-muted">Please select a valid image file</small>
                                </div>
                            </div>
                        @endif
                    </div>


                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
