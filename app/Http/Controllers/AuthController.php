<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // buat test api aja ini
    public function getUser()
    {
        $user = User::all();
        return response()->json($user);
    }

    // daftar akun (buat akun)
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|unique:user,email|max:255',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'nama' => $validated['nama'],
            'no_telp' => $validated['no_telp'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'wisatawan',// $validated['role'] ?? 'wisatawan',
            // 'remember_token' => Str::random(60),
        ]);

        return response()->json([
            'data' => $user
        ], 201);

    }

    //login akun
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('remember');

        // $user = User::where('email', $credentials['email'])->first();

        if (!Auth::attempt($credentials, $remember)) {
            return response()->json(['message' => 'Email atau password salah'], 401);
        }

        // Auth::login($user, $request->has('remember'));
        $user = Auth::user();

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token, // Untuk API calls
            'user' => $user,
            'redirect' => $user->role === 'admin'
                ? route('admin.dashboard')
                : route('user.dashboard')
        ]);
    }

    //logout akun
    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->currentAccessToken()?->delete();
        }

        // Logout dari session web
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->wantsJson()) {
        return response()->json(['message' => 'Logout berhasil']);
        }

        // Untuk request web, redirect ke halaman login
        return redirect('/login');
    }

    public function profile(Request $request)
    {
        // $user = $request->user(); // Atau pakai Auth::user()
        // return view('.dashboard', ['user' => $user]);
        return response()->json(['user' => $request->user()]);


    }



    public function updateProfile(Request $request)
    {
        // $user = Auth::guard('sanctum')->user();
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'nama' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:user,email,' . $user->id,
            'password' => 'required|string',
        ]);

        // $user->fill($validated)->save();

        $user->update($validated);
        return response()->json(['message' => 'Profil diperbarui', 'user' => $user]);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'Email tidak terdaftar'], 404);
        }

        // Generate token reset (contoh sederhana)
        $token = Str::random(60);
        $user->update(['reset_token' => $token]);

        return response()->json([
            'message' => 'Token reset telah dikirim',
            'reset_token' => $token, // Untuk testing, di production kirim via email
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $request->email)->where('reset_token', $request->token)->first();

        if (!$user) {
            return response()->json(['message' => 'Token tidak valid'], 400);
        }

        $user->update([
            'password' => Hash::make($request->password),
            'reset_token' => null,
        ]);

        return response()->json(['message' => 'Password berhasil direset']);
    }
}
