@extends('layout.main_layout')

@section('container')
    <div class="container">
        <h1 class="mt-4 mb-4">{{ $post->title }}</h1>
        @if ($post->image)
            <div>
                <img src="{{ asset('storage/' . $post->image) }}" alt="" class="card-top-img img-fluid"
                    alt="{{ $post->category->image }}">
            </div>
        @else
            <div>
                <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt=""
                    class="card-top-img img-fluid" alt="{{ $post->category->image }}">
            </div>
        @endif
        <p class="text-start mt-3 mb-3">{!! $post->body !!}</p>
        <a href="/posts" class="btn btn-primary mb-5">Kembali</a>
    </div>
@endsection
