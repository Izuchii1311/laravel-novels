@extends('dashboard.layouts.main_layouts')

@section('container')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Categories</h1>
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
                            <h3 class="card-title">Category {{ $categories->title }}</h3>

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
                                    <h1>{{ $categories->name }}</h1>
                                    <hr>
                                    <p>{!! $categories->body !!}</p>
                                    <div class="d-flex justify-content-end">
                                        <div class="d-flex justify-content-end">
                                            <a href='/dashboard/categories'
                                                class="btn btn-primary mx-2">Kembali</a>
                                            {{-- Edit --}}
                                            <a href='/dashboard/categories/{{ $categories->slug }}/edit'
                                                class="btn btn-warning mx-2">Edit</a>
                                            {{-- Delete --}}
                                            <form action="/dashboard/categories/{{ $categories->slug }}" method="POST"
                                                id="deleteForm{{ $categories->slug }}">
                                                @method('delete')
                                                @csrf
                                                {{-- type button agar tidak langsung tersubmit --}}
                                                <button type="button" class="btn btn-danger mx-2"
                                                    onclick="deletecategories('{{ $categories->slug }}')">Delete</button>
                                            </form>
                                        </div>
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

    <script>
        function deletecategories(slug) {
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
                    // jika ya, cari yang ada id deleteForm $ categories->slug , lalu actionnya isi dengan urlnya
                    document.getElementById('deleteForm' + slug).action = "/dashboard/categories/" + slug;
                    document.getElementById('deleteForm' + slug).submit();
                }
            })
        }
    </script>
@endsection
