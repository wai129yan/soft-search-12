<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
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
            // "category_id" => "required | exists:categories,id"
            
        ]);

        Product::create($request->all());

        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }
}