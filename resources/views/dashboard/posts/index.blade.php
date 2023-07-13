@extends('dashboard.layouts.main_layouts')

@section('container')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>All your posts</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a>/{{ request()->path() }}</li>
                        </ol>
                    </div>
                </div>
                {{-- alert data success --}}
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="d-flex justify-content-end">
                    <a href='/dashboard/posts/create' class="btn btn-success mx-2 my-2">Buat Post Baru +</a>
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
                            <h3 class="card-title">Posts</h3>

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
                                <table class="table table-hover table-striped">
                                    <tbody>
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td>{{ ++$pageNumber }}</td>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->excerpt }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-end">
                                                        <a href='/dashboard/posts/{{ $post->slug }}'
                                                            class="btn btn-primary mx-2">Detail</a>
                                                        {{-- Edit --}}
                                                        <a href='/dashboard/posts/{{ $post->slug }}/edit'
                                                            class="btn btn-warning mx-2">Edit</a>
                                                        {{-- Delete --}}
                                                        <form action="/dashboard/posts/{{ $post->slug }}" method="post"
                                                            id="deleteForm{{ $post->slug }}">
                                                            @method('delete')
                                                            @csrf
                                                            {{-- type button agar tidak langsung tersubmit --}}
                                                            <button type="button" class="btn btn-danger mx-2" onclick="deletePost('{{ $post->slug }}')">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- /.table -->
                            </div>
                            <!-- /.mail-box-messages -->
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            {{ $posts->onEachSide(2)->links() }}
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
        function deletePost(slug) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan bisa mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // jika ya, cari yang ada id deleteForm $ post->slug , lalu actionnya isi dengan urlnya
                    document.getElementById('deleteForm' + slug).action = "/dashboard/posts/" + slug;
                    document.getElementById('deleteForm' + slug).submit();
                }
            })
        }
    </script>
@endsection
