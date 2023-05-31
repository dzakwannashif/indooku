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

    public function tampilanEdit($id)
    {
        $category = Category::all();
        $product = Product::find($id);
        return view('products.edit', compact('product', 'category'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $rules = [
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required',
            'category_id' => 'required'
        ];

        $request->validate($rules);

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $input['image'] = $filename;
        }

        Product::create($input);
        return redirect('/products');
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $product = Product::find($id);
        if (!$product) {
            if (!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'id tidak ditemukan'
                ]);
            }
        }

        $product->update($input);
        return redirect('/products');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products');
    }
}
