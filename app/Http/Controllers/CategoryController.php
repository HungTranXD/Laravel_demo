<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list() {
        $data = Category::orderBy("id", "desc")->paginate(20);
        return view("admin.category.list", compact('data'));
    }

    public function create() {
        return view("admin.category.create");
    }

    public function store(Request $request) {
        $request->validate([
            "name" => "required|unique:categories,name|string|min:2",
            "icon" => "nullable|image|mimes:jpeg,png,jpg,svg|max:2048"
        ]);

        $data = $request->except('icon');
        //dd($data);
        try {
            if ($request->hasFile('icon')) {
                $file = $request->file('icon');
                $fileName = time() . $file->getClientOriginalName();
                $path = public_path("uploads");
                $file->move($path,$fileName);
                $data['icon'] = '/uploads/'.$fileName;
            }
        } catch (\Exception $e) {
        } finally {
            $data['icon'] = $data['icon'] ?? null;
        }

        Category::create($data);
        return redirect()->to("/admin/category");
    }

    public function edit(Category $category) {
        return view("admin.category.edit", compact('category'));
    }

    public function update(Category $category, Request $request) {
        $request->validate([
            "name" => "required|unique:categories,name|string|min:2",
            "icon" => "nullable|image|mimes:jpeg,png,jpg,svg|max:2048"
        ]);

        $data = $request->except('icon');
        //dd($data);
        try {
            if ($request->hasFile('icon')) {
                $file = $request->file('icon');
                $fileName = time() . $file->getClientOriginalName();
                $path = public_path("uploads");
                $file->move($path,$fileName);
                $data['icon'] = '/uploads/'.$fileName;
            }
        } catch (\Exception $e) {
        } finally {
            $data['icon'] = $data['icon'] ?? $category->icon;
        }

        $category->update($data);
        return redirect()->to("/admin/category");
    }

    public function delete(Category $category) {
        $category->delete();
        return redirect()->to( url("/admin/category") );
    }
}
