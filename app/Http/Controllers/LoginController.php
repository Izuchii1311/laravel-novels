<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check())
        {
            return view('dashboard.index');
        }   

        return view('authentication.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    # fungsi authentikasi
    public function authenticate(Request $request)
    {
        # validasi
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        # cek apakah akun loginnya sama atau tidak
        if(Auth::attempt($credentials))                                # memeriksa kecocokan data dengan $validatedData
        {
            $request->session()->regenerate();                          # membuat session baru dengan id yang uniq
            return redirect()->intended('/dashboard');          # akan mengarahkan ke dashboard jika berhasil login & jika tidak akan tetap berada di halaman login
        }

        # ketika gagal maka akan melakukan berikut
        return back()->with('loginError', 'Login Failed');   # mengembalikan kembali ke halaman sebelumnya yaitu halaman /login
    }

    # logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
