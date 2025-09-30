<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');
        // Eager Loading
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('status', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('category', function($categoryQuery) use ($searchTerm) {
                      $categoryQuery->where('name', 'like', '%' . $searchTerm . '%');
                  });
            });
        }

        // Optional: Filter by exact status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Add pagination (10 items per page)
        $products = $query->paginate(10)->appends($request->query());

        return view('product.product-list', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required | string",
            "description" => "nullable | string",
            "price" => "required | numeric",
            "quantity" => "required | numeric",
            "status"=> "required",
            "category_id" => "required ",
            "image" => "nullable | image | mimes:jpg,jpeg,png ",
        ]);
        if($request->hasFile("image")){
            $validated["image"] = $request->file("image")->store("products","public");
        }

       Product::create($validated);

        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }

    public function show($id)
    {
        $products = Product::findOrFail($id); //မတွေ့ဘူးဆိုရင် → Laravel က default အနေဖြင့် show 404 page
        return view('product.show', compact('products'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "name" => "required | string",
            "description" => "nullable | string",
            "price" => "required | numeric",
            "quantity" => "required | numeric",
            "status"=> "required",
            "category_id" => "required ",
            "image" => "nullable | image | mimes:jpg,jpeg,png ",
        ]);
        if($request->hasFile("image")){
            $validated["image"] = $request->file("image")->store("products","public");
        }

        $product = Product::findOrFail($id);
        $product->update($validated);

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete the image file if it exists
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }

    // soft delete
    public function trash(Request $request)
    {
        $query = Product::onlyTrashed()->with('category');
        // Eager Loading
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('status', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('category', function($categoryQuery) use ($searchTerm) {
                      $categoryQuery->where('name', 'like', '%' . $searchTerm . '%');
                  });
            });
        }

        // Add pagination (10 items per page)
        $products = $query->paginate(10)->appends($request->query());
        return view('product.deleted-products', compact('products'));
    }


    public function destroyParement($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);

        // Delete the image file if it exists
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // Permanently delete the product
        $product->forceDelete();

        return redirect()->route('product.trash')->with('success', 'Product permanently deleted successfully');
    }


    public function restoreProduct($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('product.trash')->with('success', 'Product restored successfully');
    }
}

