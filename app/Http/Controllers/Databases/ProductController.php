<?php

namespace App\Http\Controllers\Databases;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // $product = Product::query();
        // $category_id = $request->query('category_id');
        // $product->when($category_id, function($query) use($category_id){
        //     $query->where('category_id', '=', $category_id);
        // });
        // $product = $product->get();

        $category_id = $request->query('category_id');
        // alesan menggunakan query karena kita mengaksesnya menggunakan method get

        if (isset($category_id)) {
            $product = Product::whereHas('category', function ($query) use ($category_id) {
                $query->where('category_id', '=', $category_id);
            })->with('category');
        } else {
            $product = Product::with('category');
        }
        $product = $product->get();


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
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $product = Product::create($input);
        return response()->json([
            'status' => true,
            'data' => $product
        ]);
    }
}
