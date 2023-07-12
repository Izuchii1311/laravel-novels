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
                                                <label for="title" class="form-label @error('title')is-invalid @enderror"
                                                    value="{{ old('title') }}" autofocus>Title</label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                    required autocomplete="off" autofocus>
                                                @error('title')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="slug" class="form-label @error('slug')is-invalid @enderror"
                                                    value="{{ old('slug') }}">Slug</label>
                                                <input type="text" class="form-control" id="slug" name="slug"
                                                    disabled readonly autocomplete="off">
                                                <p>*slug otomatis terbuat mengambil data dari judul</p>
                                                @error('slug')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="writer"
                                                    class="form-label @error('writer')is-invalid @enderror"
                                                    value="{{ old('writer') }}">Writer</label>
                                                <input type="text" class="form-control" id="writer" name="writer"
                                                    required autocomplete="off">
                                                @error('writer')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="author"
                                                    class="form-label @error('author')is-invalid @enderror"
                                                    value="{{ old('author') }}">Author</label>
                                                <input type="text" class="form-control" id="author" name="author"
                                                    required autocomplete="off">
                                                @error('author')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="publisher"
                                                    class="form-label @error('publisher')is-invalid @enderror"
                                                    value="{{ old('publisher') }}">Publisher</label>
                                                <input type="text" class="form-control" id="publisher" name="publisher"
                                                    required autocomplete="off">
                                                @error('publisher')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="publication_year"
                                                    class="form-label @error('publication_year')is-invalid @enderror"
                                                    value="{{ old('publication_year') }}">Publication year</label>
                                                <input type="date" class="form-control" id="publication_year"
                                                    name="publication_year" required autocomplete="off">
                                                @error('publication_year')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="category_id"
                                                    class="form-label @error('category_id')is-invalid @enderror"
                                                    value="{{ old('category_id') }}">Category</label>
                                                <select class="form-select" name="category_id">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="body" class="form-label">Body</label>
                                                <input id="body" type="hidden" name="body" required
                                                    autocomplete="off">
                                                {{-- Trix Editor --}}
                                                <trix-editor input="body"></trix-editor>
                                                @error('body')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary">Create New Post</button>
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

    {{-- Fetch API JavaScript -- create slug automatically with get from title --}}
    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        // Even Handler, yang menangani ketika kita tuliskan di dalam title itu berubah.
        title.addEventListener('change', function() {
            // kita akan melakukan fetch dari controller dashboard/post/ method checkSlug()
            // data dari title diambil kemudian diolah dan dikembalikan sebagai slug
            fetch('/dashboard/posts/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
            console.log(data.slug);
        });


        // mematikan fungsi file upload di trix
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });
    </script>
@endsection
