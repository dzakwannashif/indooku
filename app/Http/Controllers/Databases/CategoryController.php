<?php

namespace App\Http\Controllers\Databases;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{


    public function index()
    {
        //! agar hanya namanya saja yang ditampilkan
        // $category = Category::select(['name'])->latest()->get();

        $category = Category::latest()->get();

        return response()->json([
            'message' => true,
            'data' => $category
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $rules = [
            'name' => 'required'
        ];

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $category = Category::create($input);
        return response()->json([
            'status' => true,
            'data' => $category,
            'message' => 'data berhasil ditambahkan'
        ]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'id tidak ditemukan'
            ]);
        }

        $category->update($input);

        return response()->json([
            'status' => true,
            'data' => $input,
            'message' => 'data berhasil di update'
        ]);
    }

    public function delete($id)
    {
        $category = Category::find($id);

        $category->delete($category);

        return response()->json([
            'status' => true,
        ]);
    }
}
