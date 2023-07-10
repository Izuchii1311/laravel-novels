@extends('authentication.layouts.main_layouts')

@section('container')
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <b class="h1">Registrasi</b>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Registrasi Akun Baru</p>

                <form action="/register" method="post">
                    @csrf {{-- Untuk menangani Cross Site Request Forgery --}}
                    <div class="input-group mb-3">
                        {{-- Memberikan name, id, class error, required, dan value --}}
                        <input type="text" name="name" id="name" class="form-control @error('name')is-invalid @enderror" placeholder="Nama Lengkap" requied value="{{ old('name') }}"  autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        {{-- Memberikan name, id, class error, required, dan value --}}
                        <input type="text" name="username" id="username" class="form-control @error('username')is-invalid @enderror" placeholder="Username" requied value="{{ old('username') }}"  autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-tie"></span>
                            </div>
                        </div>
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        {{-- Memberikan name, id, class error, required, dan value --}}
                        <input type="email" name="email" id="email" class="form-control @error('email')is-invalid @enderror" placeholder="Email" required value="{{ old('email') }}"  autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        {{-- Memberikan name, id, class error, required, dan value --}}
                        <input type="password" name="password" class="form-control @error('password')is-invalid @enderror" placeholder="Password" id="password" required value="{{ old('password') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-eye" onclick="showPassword('password', 'iconPassword')"
                                    id="iconPassword"></span>
                            </div>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row justify-content-end">
                        {{-- <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div> --}}
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                {{-- <div class="social-auth-links text-center">
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i>
                        Sign up using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i>
                        Sign up using Google+
                    </a>
                </div> --}}

                <p>Sudah punya akun? <a href="/login" class="text-center">Login</a></p>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
@endsection
