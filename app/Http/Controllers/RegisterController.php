<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('authentication.register');
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
        # Tangkap data inputan dari form Register
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'username' => 'required|min:3|max:8|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8|max:16',
        ]);

        # Hash Password
        $validatedData['password'] = Hash::make($validatedData['password']);

        # Create new User Register Account
        User::create($validatedData);
        return redirect('/login')->with("success", "Register Successfully...");
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
}
