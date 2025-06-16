<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('APP_API_URL', 'http://localhost:8000/api');
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

            return back()->with('success', 'Feedback berhasil dikirim! Menunggu persetujuan admin.');
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
