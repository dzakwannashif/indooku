<?php

namespace App\Http\Controllers\Databases;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::with(['category'])->get();

        return response()->json([
            'status' => true,
            'data' => $product,
            'message' => 'Data berhasil ditampilkan'
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $rules = [
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required',
            'description' => 'required',
            'category_id' => 'required'
        ];



        $validator = Validator::make($input, $rules);
        if ($validator->errors()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $product = Product::create($input);
        return response()->json([
            'status' => true,
            'data' => $product
        ]);
    }
}
