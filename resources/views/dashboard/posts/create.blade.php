@extends('dashboard.layouts.main_layouts')

@section('container')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create new posts</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a>/{{ request()->path() }}</li>
                        </ol>
                    </div>
                </div>

                {{-- Alert Failed Login --}}
                @if (session()->has('failed'))
                    <div class="alert alert-danger fade show" role="alert">
                        {{ session('failed') }}
                    </div>
                @endif
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">New</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body p-3">
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                        <form action="/dashboard/posts" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="title"
                                                    class="form-label @error('title')is-invalid @enderror">Title</label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                    value="{{ old('title') }}" required autocomplete="off"
                                                    autofocus>
                                                @error('title')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="slug"
                                                    class="form-label @error('slug')is-invalid @enderror">Slug</label>
                                                <input type="text" class="form-control" id="slug" name="slug"
                                                    value="{{ old('slug') }}" disabled readonly
                                                    autocomplete="off">
                                                <p>*slug otomatis terbuat mengambil data dari judul</p>
                                                @error('slug')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="writer"
                                                    class="form-label @error('writer')is-invalid @enderror">Writer</label>
                                                <input type="text" class="form-control" id="writer" name="writer"
                                                    value="{{ old('writer') }}" required autocomplete="off">
                                                @error('writer')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="author"
                                                    class="form-label @error('author')is-invalid @enderror">Author</label>
                                                <input type="text" class="form-control" id="author" name="author"
                                                    value="{{ old('author') }}" required autocomplete="off">
                                                @error('author')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="publisher"
                                                    class="form-label @error('publisher')is-invalid @enderror">Publisher</label>
                                                <input type="text" class="form-control" id="publisher" name="publisher"
                                                    value="{{ old('author') }}" required autocomplete="off">
                                                @error('publisher')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="publication_year"
                                                    class="form-label @error('publication_year')is-invalid @enderror">Publication
                                                    year</label>
                                                <input type="date" class="form-control" id="publication_year"
                                                    name="publication_year"
                                                    value="{{ old('publication_year') }}" required
                                                    autocomplete="off">
                                                @error('publication_year')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="category_id"
                                                    class="form-label @error('category_id')is-invalid @enderror">Category</label>
                                                <select class="form-select" name="category_id"
                                                    value="{{ old('category_id') }}">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{-- Upload Image --}}
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Upload Image</label>
                                                <img class="img-preview mb-3 col-sm-5 img-fluid" style="display: none;">
                                                <input type="file" class="form-control @error('image')is-invalid @enderror" id="image" name="image" onchange="previewImage()">
                                                @error('image')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="body" class="form-label">Body</label>
                                                <input id="body" type="hidden" name="body" required
                                                    autocomplete="off" value="{{ old('body') }}">
                                                {{-- Trix Editor, diberikan input body agar kita bisa memasukkan valuenya --}}
                                                <trix-editor input="body"></trix-editor>
                                                @error('body')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <br>
                                            <a href="/dashboard/posts" class="btn btn-primary mx-2">Kembali</a>
                                            <button type="submit" class="btn btn-success mx-2">Create New Post</button>
                                        </form>
                                    </tbody>
                                </table>
                                <!-- /.table -->
                            </div>
                            <!-- /.mail-box-messages -->
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
