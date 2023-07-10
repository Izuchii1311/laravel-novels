@extends('layout.main_layout')

@section('container')
    <div class="container">
        <div class="row">
            <h3 class="mt-4">List Category</h3>
            <ul class="ms-4">
                @foreach ($categories as $category)
                    <li>
                        <a href="/posts?category={{ $category->slug }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
