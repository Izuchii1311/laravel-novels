<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        # pengecekan menggunakan Gates
        // $this->authorize('admin');

        # bisa diakses jika dia admin
        return view('/dashboard/categories/index', [
            "categories" => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('/dashboard/categories/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (
            empty($request->name) ||
            empty($request->body)
        ) {
            return back()->with("failed", "Create new post failed. You must fill in all input fields");
        }

        $validatedData = $request->validate([
            "name" => 'required|max:20',
            "body" => 'required'
        ]);

        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 75);

        # upload data
        Category::create($validatedData);

        # redirect + message
        return redirect('/dashboard/categories')->with("success", "New Categories created has ben successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('/dashboard/categories/show', [
            "categories" => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('/dashboard/categories/edit', [
            "categories" => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            "name" => 'required|max:20',
            "body" => 'required'
        ]);

        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 75);

        # upload data
        Category::where('id', $category->id)
            ->update($validatedData);

        return redirect('/dashboard/categories')->with('success', 'Categories has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Post::where('category_id', $category->id)->delete();
        Category::destroy($category->id);
        return redirect('/dashboard/categories')->with('success', "Category & Post has ben deleted!");
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
