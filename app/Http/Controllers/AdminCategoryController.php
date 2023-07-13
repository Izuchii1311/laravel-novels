<?php

namespace App\Http\Controllers;

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
        return redirect('/dashboard/categories')->with("success", "New Post created has ben successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }

}
