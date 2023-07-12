@extends('dashboard.layouts.main_layouts')

@section('container')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Posts</h1>
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
                            <h3 class="card-title">Post {{ $post->title }}</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Search Title">
                                    <div class="input-group-append">
                                        <div class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive mailbox-messages">
                                <div class="p-4">
                                    <h1>{{ $post->title }}</h1>
                                    <br>
                                    <p>{!! $post->body !!}</p>
                                    <br><br><hr>
                                    <p>
                                        Category : {{ $post->category->name }} <br>
                                        Penulis : {{ $post->writer }} <br>
                                        Pengarang : {{ $post->author }} <br>
                                        Penerbit : {{ $post->publisher }} <br>
                                        Diterbitkan : {{ $post->publication_year }}
                                    </p>
                                    <p>
                                        <div class="d-flex justify-content-end">
                                            <a href='/dashboard/posts' class="btn btn-primary mx-2">Kembali</a>
                                            <a href='/dashboard/posts' class="btn btn-warning mx-2">Edit</a>
                                            <button class="btn btn-danger mx-2">Delete</button>
                                        </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
