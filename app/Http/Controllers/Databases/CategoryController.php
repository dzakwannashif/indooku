<?php

namespace App\Http\Controllers\Databases;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{


    public function index()
    {
        //! agar hanya namanya saja yang ditampilkan
        // $category = Category::select(['name'])->latest()->get();

        $category = Category::get()->map(function ($categorySingle) {
            $categorySingle->image = url('uploads/' . $categorySingle->image);
            $categorySingle->product_count = $categorySingle->products()->count();
            return $categorySingle;
        });

        return response()->json([
            'message' => true,
            'data' => $category
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $rules = [
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:3048'

        ];

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        if ($request->file('image')) {
            $file = $request->file('image');
            $fileName = time() . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
            $input['image'] = $fileName;
        } else {
            unset($input['image']);
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

        if ($request->file('image')) {
            $path = 'uploads' . '/' . $category->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $input['image'] = $fileName;
        } else {
            unset($input['image']);
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
        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'id not found',
            ]);
        }
        $path = 'uploads' . '/' . $category->image;
        if (File::exists($path)) {
            File::delete($path);
        }

        $category->delete($category);

        return response()->json([
            'status' => true,
            'message' => 'data berhasil di hapus',
        ]);
    }
}
