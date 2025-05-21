<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // buat test api aja ini
    public function getUser() {

        $user = User::all();
        return response()->json($user);

    }

    // daftar akun (buat akun)
    public function register(Request $request) 
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            // 'no_telp' => 'required|string|max:20',
            'email' => 'required|email|unique:user,email|max:255',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'nama' => $validated['nama'],
            // 'no_telp' => $validated['no_telp'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $validated['role'] ?? 'wisatawan',
        ]);

        return response()->json([
            'data' => $user
        ], 201);
        
    }

    public function login(Request $request) 
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // if (!Auth::attempt($request->only('email', 'password'))) {
        //     return response()->json(['message' => 'Kredensial tidak valid'], 401);
        // }

        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            return response()->json(['message' => 'Email tidak terdaftar'], 401);
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Password salah'], 401);
        }

        Auth::login($user);
        return response()->json([
            'message' => 'Login berhasil',
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return response()->json(['message' => 'Logout berhasil']);
    }

    public function profile()
    {
        $user = Auth::user();
        
        if (!$user) {
        return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json($user);
    }

}
