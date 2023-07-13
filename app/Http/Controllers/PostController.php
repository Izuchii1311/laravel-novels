<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Routing\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titleActive = '';
        # search request
        if(request('category'))
        {
            $category = Category::firstWhere('slug', request('category'));
            $titleActive = 'Posts dengan kategori ' . $category->name;
        }

        if(request('authors'))
        {
            $authors = User::firstWhere('username', request('authors'));
            $titleActive = 'Posts yang dibuat oleh ' . $authors->username;
        }

        return view('posts', [
            "titleActive" => $titleActive,
            "posts" => Post::latest()->filterSearch(request(['search', 'category', 'authors']))
                            ->paginate(10)
                            ->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post', [
            "post" => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
