<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('APP_API_URL', 'http://localhost:8000/api');
    }

    public function showProfile()
    {
        return view('wisatawan.profile', [
            'user' => auth()->user(),
        ]);
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = auth()->user(); // Get authenticated user

            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|email|unique:user,email,' . $user->id,
                'no_telp' => 'required|string|max:20',
                'foto_user' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Handle file upload
            if ($request->hasFile('foto_user')) {
                // Delete old photo if exists
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
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Gagal memperbarui profil: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Show feedback form view
     */
    public function feedbackForm()
    {
        return view('wisatawan.feedback-form')->with([
            'token' => session('token'),
        ]);
    }

    /**
     * Handle feedback submission
     */
    public function tambahFeedback(Request $request)
    {
        // Cek apakah user sudah pernah memberikan feedback
        $existingFeedback = Feedback::where('user_id', auth()->id())->first();

        if ($existingFeedback) {
            return back()->with('error', 'Anda sudah memberikan feedback sebelumnya.');
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'pesan' => 'required|string|max:500',
            'rating' => 'required|integer|between:1,5',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Validasi gagal. Silakan periksa input Anda.');
        }

        try {
            // Create feedback
            $feedback = Feedback::create([
                'user_id' => auth()->id(),
                'pesan' => $request->pesan,
                'rating' => $request->rating,
                'status' => 'pending',
            ]);

            return back()->with('success', 'Feedback berhasil dikirim!');
        } catch (\Exception $e) {
            logger()->error('Feedback submission error', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat mengirim feedback');
        }
    }

    /**
     * API request helper
     */
    public function apiRequest($method, $url, $data = [])
    {
        try {
            $response = Http::withToken(session('token'))->$method($this->apiUrl . $url, $data);
            return $response->json();
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error connecting to API: ' . $e->getMessage(),
            ];
        }
    }
}
