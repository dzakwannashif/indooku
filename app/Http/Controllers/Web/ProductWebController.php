<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductWebController extends Controller
{
    public function index()
    {
        $product = Product::orderBy('name', 'asc')->get();
        return view('products.index', compact('product'));
    }

    public function tampilanStore()
    {
        $category = Category::all();
        return view('products.create', compact('category'));
    }
}
