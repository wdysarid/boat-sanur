<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

class AuthController extends Controller
{
    // EXISTING FUNCTION - tidak diubah
    public function getUser()
    {
        $user = User::all();
        return response()->json($user);
    }

    // EXISTING FUNCTION - tidak diubah
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
            'role' => 'wisatawan',
            'password_changed_at' => now(),
        ]);

        // Trigger email verification untuk API register juga
        event(new Registered($user));

        return response()->json(
            [
                'data' => $user,
                'message' => 'Registrasi berhasil! Silakan cek email untuk verifikasi.',
            ],
            201,
        );
    }

    // EXISTING FUNCTION - tidak diubah
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('remember');

        if (!Auth::attempt($credentials, $remember)) {
            return response()->json(['message' => 'Email atau password salah'], 401);
        }

        $user = Auth::user();

        // Check email verification untuk API login juga
        if (is_null($user->email_verified_at)) {
            Auth::logout();
            return response()->json(
                [
                    'message' => 'Email belum diverifikasi. Silakan cek email Anda.',
                    'email_verified' => false,
                ],
                403,
            );
        }

        $token = $user->createToken('api-token')->plainTextToken;
        session(['token' => $token]);

        logger()->info('User logged in', [
            'user_id' => auth()->id(),
            'session_id' => session()->getId(),
            'ip' => $request->ip(),
        ]);

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => $user,
            'redirect' => $user->role === 'admin' ? route('admin.dashboard') : route('wisatawan.dashboard'),
        ]);
    }

    // EXISTING FUNCTION - tidak diubah
    public function logout(Request $request)
    {
        // Ambil nama user sebelum logout (jika ada) - PERBAIKAN ERROR
        $userName = 'User';
        if (Auth::check() && Auth::user()) {
            $userName = Auth::user()->nama ?? 'User';
        }

        if ($request->user()) {
            $request->user()->currentAccessToken()?->delete();
        }

        // Logout dari session web
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Log logout activity
        Log::info('User logged out', ['user' => $userName]);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Logout berhasil']);
        }

        // Untuk request web, redirect ke halaman login
        return redirect('/login');
    }

    // EXISTING FUNCTION - tidak diubah
    public function profile(Request $request)
    {
        return response()->json(['user' => $request->user()]);
    }

    // EXISTING FUNCTION - tidak diubah
    public function updateProfile(Request $request)
    {
        // Dapatkan user_id dari input form
        $userId = $request->input('user_id');

        // Cari user berdasarkan ID
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'nama' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:user,email,' . $user->id,
            'no_telp' => 'sometimes|string|max:20',
            'foto_user' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_photo' => 'sometimes|boolean',
        ]);

        // Handle photo removal
        if ($request->input('remove_photo') == '1') {
            // Hapus foto lama jika ada
            if ($user->foto_user && Storage::disk('public')->exists($user->foto_user)) {
                Storage::disk('public')->delete($user->foto_user);
            }
            $validated['foto_user'] = null; // Set to null to clear the photo path
        }
        // Handle file upload
        elseif ($request->hasFile('foto_user')) {
            // Hapus foto lama jika ada
            if ($user->foto_user && Storage::disk('public')->exists($user->foto_user)) {
                Storage::disk('public')->delete($user->foto_user);
            }

            $file = $request->file('foto_user');
            $filename = 'profile_' . time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profile_photos', $filename, 'public');
            $validated['foto_user'] = $path;
        }

        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui',
            'user' => $user,
        ]);
    }

    // EXISTING FUNCTION - tidak diubah
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak terdaftar pada sistem kami.');
        }

        // Cek jika akun Google
        if ($user->google_id) {
            return back()->with('error', 'Akun ini terdaftar melalui Google. Silakan gunakan fitur login dengan Google.');
        }

        $token = Str::random(60);
        $user->update(['reset_token' => $token]);

        try {
            Mail::to($user->email)->send(new ResetPasswordMail($user, $token));
            return back()->with('status', 'Link reset password telah dikirim ke email Anda. Silakan cek inbox atau folder spam.');
        } catch (\Exception $e) {
            Log::error('Failed to send reset password email: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengirim email reset password. Silakan coba lagi.');
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)->where('reset_token', $request->token)->first();

        if (!$user) {
            return back()->with('error', 'Token tidak valid atau sudah kadaluarsa');
        }

        // Pengecekan akun Google
        if ($user->google_id) {
            return back()->with('error', 'Akun Google tidak dapat diubah password melalui sistem ini. Silakan ubah password melalui akun Google Anda.');
        }

        $user->update([
            'password' => Hash::make($request->password),
            'reset_token' => null,
            'password_changed_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Password berhasil direset! Silakan login dengan password baru.');
    }

    // ========== WEB AUTHENTICATION METHODS ==========

    // EXISTING FUNCTION - tidak diubah
    public function webRegister(Request $request)
    {
        // TAMBAHAN: Store intended URL jika ada
        if ($request->has('intended')) {
            session(['url.intended' => $request->get('intended')]);
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|unique:user,email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            $user = User::create([
                'nama' => $validated['nama'],
                'no_telp' => $validated['no_telp'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'wisatawan',
                'password_changed_at' => now(), // Selalu wisatawan untuk registrasi
            ]);

            Log::info('User registered', [
                'user_id' => $user->id,
                'email' => $user->email,
                'role' => $user->role,
            ]);

            // Trigger email verification
            event(new Registered($user));

            // Auto login setelah registrasi
            Auth::login($user);

            return redirect()->route('verification.notice')->with('success', 'Registrasi berhasil! Silakan cek email Anda untuk verifikasi akun.');
        } catch (Exception $e) {
            Log::error('Registration failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'Registrasi gagal. Silakan coba lagi.')->withInput();
        }
    }

    // MODIFIKASI: Web Login dengan fitur booking redirect
    public function webLogin(Request $request)
    {
        // TAMBAHAN: Store intended URL jika ada
        if ($request->has('intended')) {
            session(['url.intended' => $request->get('intended')]);
        }

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('remember');

        Log::info('Login attempt', ['email' => $credentials['email']]);

        if (!Auth::attempt($credentials, $remember)) {
            Log::warning('Login failed', ['email' => $credentials['email']]);
            return back()
                ->withErrors([
                    'email' => 'Email atau password salah',
                ])
                ->withInput($request->only('email', 'remember'));
        }

        $user = Auth::user();

        // Check if email is verified
        if (is_null($user->email_verified_at)) {
            return redirect()->route('verification.notice')->with('warning', 'Silakan verifikasi email Anda terlebih dahulu sebelum mengakses dashboard.');
        }

        Log::info('Login successful', [
            'user_id' => $user->id,
            'role' => $user->role,
            'nama' => $user->nama,
        ]);

        $request->session()->regenerate();

        // PERUBAHAN BESAR: Gunakan method baru untuk handle multiple intent types
        return $this->handleIntendedRedirect($user);
    }

    // ========== GOOGLE OAUTH METHODS ==========

    // EXISTING FUNCTION - tidak diubah
    public function redirectToGoogle()
    {
        try {
            Log::info('Redirecting to Google OAuth');
            return Socialite::driver('google')->redirect();
        } catch (Exception $e) {
            Log::error('Google OAuth Redirect Error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Tidak dapat terhubung ke Google. Silakan coba lagi.');
        }
    }

    // MODIFIKASI: Google OAuth callback dengan fitur booking redirect
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            Log::info('Google OAuth Success', [
                'google_id' => $googleUser->id,
                'email' => $googleUser->email,
                'name' => $googleUser->name,
            ]);

            // Check if user already exists with this Google ID
            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                // PERBAIKAN: Pastikan Google user sudah verified
                if (is_null($user->email_verified_at)) {
                    $user->update(['email_verified_at' => now()]);
                }

                Auth::login($user);
                Log::info('Existing Google user logged in', [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'role' => $user->role,
                ]);

                // PERUBAHAN: Gunakan method baru untuk handle redirect
                return $this->handleIntendedRedirect($user);
            }

            // Check if user exists with this email (untuk link akun existing)
            $existingUser = User::where('email', $googleUser->email)->first();

            if ($existingUser) {
                // Link Google account ke user yang sudah ada
                $existingUser->update([
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'email_verified_at' => now(), // AUTO VERIFY untuk Google OAuth
                ]);

                Auth::login($existingUser);
                Log::info('Existing user linked with Google', [
                    'user_id' => $existingUser->id,
                    'email' => $existingUser->email,
                    'role' => $existingUser->role,
                ]);

                // PERUBAHAN: Gunakan method baru untuk handle redirect
                return $this->handleIntendedRedirect($existingUser);
            }

            // CREATE NEW USER - REGISTRASI OTOMATIS SEPERTI GOOGLE UMUMNYA
            $newUser = User::create([
                'nama' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'password' => Hash::make(Str::random(24)), // Random password karena login pakai Google
                'role' => 'wisatawan', // Selalu wisatawan untuk Google OAuth
                'no_telp' => '', // Kosong, bisa diisi nanti di profile
                'email_verified_at' => now(), // AUTO VERIFY untuk Google OAuth
            ]);

            Auth::login($newUser);
            Log::info('New Google user created and logged in', [
                'user_id' => $newUser->id,
                'email' => $newUser->email,
                'role' => $newUser->role,
            ]);

            // PERUBAHAN: Gunakan method baru untuk handle redirect
            return $this->handleIntendedRedirect($newUser);
        } catch (Exception $e) {
            Log::error('Google OAuth Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect()->route('login')->with('error', 'Login dengan Google gagal. Silakan coba lagi.');
        }
    }

    // EXISTING FUNCTION - tidak diubah
    private function redirectBasedOnRole($user)
    {
        Log::info('Redirecting user based on role', [
            'user_id' => $user->id,
            'role' => $user->role,
            'nama' => $user->nama,
        ]);

        if ($user->role === 'admin') {
            Log::info('Redirecting to admin dashboard');
            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Selamat datang, Admin ' . $user->nama . '!');
        } else {
            Log::info('Redirecting to user dashboard');
            return redirect()
                ->route('wisatawan.dashboard')
                ->with('success', 'Selamat datang, ' . $user->nama . '!');
        }
    }

    // FITUR BARU: Method untuk handle multiple types of intended redirects
    // Menggabungkan booking redirect dan feedback redirect yang sudah ada
    private function handleIntendedRedirect($user)
    {
        $intendedUrl = session('url.intended');

        if ($intendedUrl) {
            // FITUR BARU: Handle booking intent specifically untuk ticket booking
            if (str_contains($intendedUrl, 'pemesanan')) {
                $bookingIntent = session('booking_intent');
                if ($bookingIntent) {
                    // Clear session setelah digunakan
                    session()->forget(['booking_intent', 'url.intended']);
                    return redirect()->route('wisatawan.pemesanan', $bookingIntent)->with('success', 'Login berhasil! Silakan lanjutkan pemesanan Anda.');
                }
            }

            // EXISTING FUNCTIONALITY: Handle feedback intent (tidak diubah untuk menjaga compatibility)
            if (str_contains($intendedUrl, '#feedback')) {
                session()->forget('url.intended');
                return redirect($intendedUrl)->with('success', 'Login berhasil! Sekarang Anda dapat memberikan feedback.');
            }

            // EXISTING FUNCTIONALITY: Handle other intended URLs (tidak diubah)
            session()->forget('url.intended');
            return redirect($intendedUrl)->with('success', 'Login berhasil! Selamat datang, ' . $user->nama . '!');
        }

        // Default redirect berdasarkan role (tidak diubah)
        return $this->redirectBasedOnRole($user);
    }
}
