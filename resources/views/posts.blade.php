@extends('layout.main_layout')

@section('container')
    <div class="container justify-content-center">

        <div class="row justify-content-end">
            <div class="col-4">
                @if (request('category'))
                    <h2 class="mt-4 mb-4 ">posts {{ $titleActive }}</h2>
                @elseif (request('authors'))
                    <h2 class="mt-4 mb-4 ">posts {{ $titleActive }}</h2>
                @else
                    <h2 class="mt-4 mb-4 ">All posts</h2>
                @endif
            </div>
            <div class="col-8 mt-4">
                {{-- Get Data search - action ke halaman posts --}}
                <form action="/posts" method="GET">
                    {{-- request pencarian berdasarkan category --}}
                    @if (request('category'))
                        <input type="hidden" name="category" id="category" value="{{ request('category') }}">
                    @endif
                    {{-- request pencarian berdasarkan authors --}}
                    @if (request('authors'))
                        <input type="hidden" name="authors" id="authors" value="{{ request('authors') }}">
                    @endif
                    {{-- request pencarian berdasarkan search --}}
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" id="search" placeholder="Search..."
                            value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary" id="search-button"><i
                                class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-3 mt-3">
                <div class="card text-center justify-content-center">
                    @if ($posts[0]->image)
                        <div>
                            <img src="{{ asset('storage/' . $posts[0]->image) }}" alt=""
                                class="card-top-img img-fluid" alt="{{ $posts[0]->category->image }}">
                        </div>
                    @else
                        <div>
                            <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" alt=""
                                class="card-top-img img-fluid" alt="{{ $posts[0]->category->image }}">
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $posts[0]->title }}</h5>
                        <p>
                            <a href="/posts?category={{ $posts[0]->category->slug }}"
                                class="text-decoration-none ">{{ $posts[0]->category->name }}</a> - <a
                                href="/posts?authors={{ $posts[0]->user->username }}"
                                class="text-decoration-none">{{ $posts[0]->user->name }}</a>
                        </p>
                        <hr>
                        <p class="card-text">{{ $posts[0]->excerpt }}</p>
                        <a href="/post/{{ $posts[0]->slug }}" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- count()
        untuk mengecek apakah ada jumlah data yang dicari ? jika ada maka tampilkan jika tidak ada, maka akan bernilai 0 dan akan menjalankan else-nya
    --}}
        @if ($posts->count())
            <div class="row">
                @foreach ($posts->skip(1) as $post)
                    <div class="col-4 mb-3 mt-3">
                        <div class="card">
                            @if ($post->image)
                                <div>
                                    <img src="{{ asset('storage/' . $post->image) }}" alt=""
                                        class="card-top-img img-fluid" alt="{{ $post->category->image }}">
                                </div>
                            @else
                                <div>
                                    <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}"
                                        alt="" class="card-top-img img-fluid" alt="{{ $post->category->image }}">
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p>
                                    <a href="/posts?category={{ $post->category->slug }}"
                                        class="text-decoration-none ">{{ $post->category->name }}</a> - <a
                                        href="/posts?authors={{ $post->user->username }}"
                                        class="text-decoration-none">{{ $post->user->name }}</a>
                                </p>
                                <hr>
                                <p class="card-text">{{ $post->excerpt }}</p>
                                <a href="/post/{{ $post->slug }}" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center mt-5">{{ request('search') }} not found.</p>
        @endif
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-5 mb-5">
        {{ $posts->links() }}
    </div>
@endsection
