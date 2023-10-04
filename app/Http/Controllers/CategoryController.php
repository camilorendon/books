<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Category\CategoryRequest;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::get();
        if (!$request->ajax()) return view();
        return response()->json(['users' => $categories], 200);
    }



    public function create()
    {
        //
    }

    public function store(CategoryRequest $request)
    {
        $category= new Category($request->all());
        $category->save();
        if (!$request->ajax()) return back()->with('success', 'Author Created');
        return response()->json(['status' => 'Category Created', 'author' => $category], 201);
    }


    public function show(Request $request, Category $category)
    {
        if (!$request->ajax()) return view();
        return response()->json(['author' => $category], 200);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        if (!$request->ajax()) return back()->with('success', 'Category Update');
        return response()->json([], 204);
    }


    public function destroy(Request $request, Category $category)
    {
        $category->delete();
        if (!$request->ajax()) return back()->with('success', 'Category deleted');
        return response()->json([], 204);
    }
}
