<?php

namespace App\Http\Controllers\Databases;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
        $productsArr = $product->get()->toArray();
        $productsData = array_map(function ($productSingle) {
            $productSingle['image'] = url('uploads/' . $productSingle['image']);
            return $productSingle;
        }, $productsArr);


        return response()->json([
            'status' => true,
            'data' => $productsData,
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
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
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

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $input['image'] = $filename;
        } else {
            unset($input['image']);
        }

        $product = Product::create($input);
        return response()->json([
            'status' => true,
            'data' => $product
        ]);
    }

    function update(Request $request, $id)
    {
        $input = $request->all();

        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'id tidak ditemukan'
            ]);
        }

        if ($request->file('image')) {
            $path = 'uploads' . '/' . $product->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $input['image'] = $filename;
        } else {
            unset($input['image']);
        }

        $product->update($input);
        return response()->json([
            'status' => true,
            'data' => $product,
            'message' => 'selamat data berhasil di update'
        ]);
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'id not found',
            ]);
        }

        $path = 'uploads' . '/' . $product->image;
        if (File::exists($path)) {
            File::delete($path);
        }

        $product->delete($product);

        return response()->json([
            'status' => true,
            'message' => 'data berhasil dihapus'
        ]);
    }
}
