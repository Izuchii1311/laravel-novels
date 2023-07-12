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
                                        <form action="/dashboard/posts" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" class="form-control" id="title" name="title">
                                            </div>
                                            <div class="mb-3">
                                                <label for="slug" class="form-label">Slug</label>
                                                <input type="text" class="form-control" id="slug" name="slug"
                                                    disabled readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="writer" class="form-label">Writer</label>
                                                <input type="text" class="form-control" id="writer" name="writer">
                                            </div>
                                            <div class="mb-3">
                                                <label for="author" class="form-label">Author</label>
                                                <input type="text" class="form-control" id="author" name="author">
                                            </div>
                                            <div class="mb-3">
                                                <label for="publisher" class="form-label">Publisher</label>
                                                <input type="text" class="form-control" id="publisher" name="publisher">
                                            </div>
                                            <div class="mb-3">
                                                <label for="publication_year" class="form-label">Publication year</label>
                                                <input type="date" class="form-control" id="publication_year" name="publication_year">
                                            </div>
                                            <div class="mb-3">
                                                <label for="category" class="form-label">Category</label>
                                                <select class="form-select" name="category_id">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="body" class="form-label">Body</label>
                                                <input id="body" type="hidden" name="body">
                                                <trix-editor input="body"></trix-editor>
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

{{-- Fetch API JavaScript, untuk mengambil judulnya dan merubahnya menjadi slug secara otomatis --}}
<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');
    // Even Handler, yang menangani ketika kita tuliskan di dalam title itu berubah.
    title.addEventListener('change', function() {
      // kita akan melakukan fetch dari controller dashboard post
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
