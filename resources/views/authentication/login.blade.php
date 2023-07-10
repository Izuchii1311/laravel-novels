@extends('authentication.layouts.main_layouts')

@section('container')
    {{-- Alert Success Register --}}
    @if (session()->has('success'))
        <div class="alert alert-success fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Alert Failed Login --}}
    @if (session()->has('loginError'))
        <div class="alert alert-danger fade show" role="alert">
            {{ session('loginError') }}
        </div>
    @endif

    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <b class="h1">Login</b>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Login dan Masuk ke dalam Aplikasi</p>

                <form action="/login" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" id="email"
                            class="form-control @error('email')is-invalid @enderror" placeholder="Email" required
                            value="{{ old('email') }}" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') @enderror" placeholder="Password" id="password"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                {{-- add Js function for show password --}}
                                <span class="fas fa-eye" onclick="showPassword()" id="iconPassword"></span>
                            </div>
                        </div>
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="row justify-content-end">
                        {{-- <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div> --}}
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                {{-- <div class="social-auth-links text-center mt-2 mb-3">
                        <a href="#" class="btn btn-block btn-primary">
                            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                        </a>
                        <a href="#" class="btn btn-block btn-danger">
                            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                        </a>
                    </div> --}}
                <!-- /.social-auth-links -->

                {{-- <p class="mb-1">
                        <a href="forgot-password.html">I forgot my password</a>
                    </p> --}}
                <p class="mb-0">
                <p>Belum punya akun? <a href="/register" class="text-center">Registrasi akun</a></p>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
@endsection
