<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryWebController extends Controller
{
    public function tampil()
    {

        $datas = Category::orderBy('created_at', 'asc')->get();
        return view('category.index', compact('datas'));
    }

    public function tampilCreate()
    {
        return view('category.create');
    }

    public function tampilEdit($id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $rules = [
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ];

        $request->validate($rules);

        if ($request->file('image')) {
            $file = $request->file('image');
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $input['image'] = $fileName;
        }

        Category::create($input);
        return redirect('/category');
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

        return redirect('/category');
    }

    public function delete($id)
    {
        $category = Category::find($id);

        $category->delete();

        return redirect('/category');
    }
}
