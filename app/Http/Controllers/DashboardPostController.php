<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        # mengambil data dari model Post berdasarkan user_id, & mengambil data id dari user yang telah berhasil authentication
        $posts = Post::where('user_id', auth()->user()->id)
            ->paginate(10)
            ->withQueryString();

        # number Page
        $pageNumber = ($posts->currentPage() - 1) * $posts->perPage();

        return view('dashboard.posts.index', [
            "posts" => $posts,
            "pageNumber" => $pageNumber
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            # menampilkan semua data category agar digunakan di dalam form saat create data
            "categories" => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if the required input fields are empty
        if (
            empty($request->category_id) ||
            empty($request->title) ||
            empty($request->writer) ||
            empty($request->author) ||
            empty($request->publisher) ||
            empty($request->publication_year) ||
            empty($request->body)
        ) {
            return back()->with("failed", "Create new post failed. You must fill in all input fields");
        }

        # validate inputan
        $validatedData = $request->validate([
            "category_id" => 'required',
            "title" => 'required|max:100',
            # tidak memerlukan 'slug' untuk di validasi karena slug sudah dibuat secara otomatis.
            # karena data diatangkap oleh $request-> dan melakukan validasi pada beberapa inputannya
            # maka untuk slug tetap berada di dalam $request tidak perlu divalidasi lagi, karena input typenya tidak bisa diisi
            // 'slug' => 'required|unique:posts',
            "writer" => 'required',
            "author" => 'required',
            "publisher" => 'required',
            "publication_year" => 'required',
            "body" => 'required'
        ]);

        # retrieve the user_id of the user who is currently logged in
        $validatedData['user_id'] = auth()->user()->id;

        # excerpt will retrieve data from the body
        // doc: laravel.com/string helpers
        # limit() data yang diambil & menghilangkan tag html
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 75);

        # upload data
        Post::create($validatedData);

        # redirect + message
        return redirect('/dashboard/posts')->with("success", "New Post created has ben successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            "post" => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            "post" => $post,
            "categories" => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        # validate inputan
        $rules = [
            "category_id" => 'required',
            "title" => 'required|max:100',
            # tidak memerlukan 'slug' untuk di validasi karena slug sudah dibuat secara otomatis.
            # karena data diatangkap oleh $request-> dan melakukan validasi pada beberapa inputannya
            # maka untuk slug tetap berada di dalam $request tidak perlu divalidasi lagi, karena input typenya tidak bisa diisi
            // 'slug' => 'required|unique:posts',
            "writer" => 'required',
            "author" => 'required',
            "publisher" => 'required',
            "publication_year" => 'required',
            "body" => 'required'
        ];

        $validatedData = $request->validate($rules);

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 75);

        Post::where('id', $post->id)
            ->update($validatedData);

        return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        # menghapus post berdasarkan id
        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with('success', "Posts has ben deleted!");
    }

    # New Method, untuk menangani permintaan slug
    # $request akan mengambil title yang diinput
    public function checkSlug(Request $request)
    {
        # doc : https://github.com/cviebrock/eloquent-sluggable
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
