<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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

}
