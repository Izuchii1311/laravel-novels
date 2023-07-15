@extends('dashboard.layouts.main_layouts')

@section('container')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit category</h1>
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
                                        <form action="/dashboard/categories/{{ $categories->slug }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="name"
                                                    class="form-label @error('name')is-invalid @enderror">name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ old('name', $categories->name) }}" required autocomplete="off"
                                                    autofocus>
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="slug"
                                                    class="form-label @error('slug')is-invalid @enderror">Slug</label>
                                                <input type="text" class="form-control" id="slug" name="slug"
                                                    value="{{ old('slug', $categories->slug) }}" disabled readonly
                                                    autocomplete="off">
                                                <p>*slug otomatis terbuat mengambil data dari name-nya</p>
                                                @error('slug')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="body" class="form-label">Body</label>
                                                <input id="body" type="hidden" name="body" required
                                                    autocomplete="off" value="{{ old('body', $categories->body) }}">
                                                {{-- Trix Editor, diberikan input body agar kita bisa memasukkan valuenya --}}
                                                <trix-editor input="body"></trix-editor>
                                                @error('body')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <br>
                                            <a href="/dashboard/categoriess" class="btn btn-primary mx-2">Kembali</a>
                                            <button type="submit" class="btn btn-success mx-2">Update categories</button>
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

    <script>
        // Category Slug
        const name = document.querySelector('#name');
        const slug = document.querySelector('#slug');
        name.addEventListener('change', function() {
            fetch('/dashboard/categories/checkSlug?name=' + name.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
            console.log(data.slug);
        });
    </script>
@endsection
