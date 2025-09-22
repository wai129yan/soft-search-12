@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0 font-weight-bold">Add New Product</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('product.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('product.form')

                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('product.index')}}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>

    </div>

@endsection
