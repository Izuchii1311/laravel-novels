@extends('layout.main_layout')

@section('container')
    <div class="container">
        <h1 class="mt-4 mb-4">{{ $post->title }}</h1>
        <img src="https://source.unsplash.com/1200x400?/health" class="card-img-top mb-3" alt="...">
        <p class="text-start mt-3 mb-3">{!! $post->body !!}</p>
        <a href="/posts" class="btn btn-primary mb-5">Kembali</a>
    </div>
@endsection
