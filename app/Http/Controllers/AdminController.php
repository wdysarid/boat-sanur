<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('APP_API_URL', 'http://localhost:8000/api');
    }

    public function indexKapal()
    {
        return view('admin.boats');
    }

    public function indexSchedule()
    {
        return view('admin.schedule');
    }

    public function indexFeedback()
    {
        return view('admin.feedback')->with([
            'token' => session('token'),
        ]);
    }

    public function getFeedbackData(Request $request)
    {
        try {
            $query = Feedback::with(['user']); // Remove withTrashed()

            // Filter by status
            if ($request->has('status') && $request->status !== 'all') {
                $query->where('status', $request->status);
            }

            // Search functionality
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->whereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('nama', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
                    })->orWhere('pesan', 'like', "%{$search}%");
                });
            }

            $feedbacks = $query->orderBy('created_at', 'desc')->paginate(15);

            // Calculate statistics
            $stats = [
                'total' => Feedback::count(),
                'pending' => Feedback::where('status', 'pending')->count(),
                'approved' => Feedback::where('status', 'disetujui')->count(),
                'rejected' => Feedback::where('status', 'ditolak')->count(),
                'average_rating' => Feedback::where('status', 'disetujui')->avg('rating') ?? 0,
                'rating_distribution' => $this->getRatingDistribution(),
            ];

            return response()->json([
                'success' => true,
                'data' => $feedbacks->items(),
                'current_page' => $feedbacks->currentPage(),
                'last_page' => $feedbacks->lastPage(),
                'per_page' => $feedbacks->perPage(),
                'total' => $feedbacks->total(),
                'from' => $feedbacks->firstItem(),
                'to' => $feedbacks->lastItem(),
                'stats' => $stats,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    private function getRatingDistribution()
    {
        $total = Feedback::count();
        $distribution = [];

        for ($i = 1; $i <= 5; $i++) {
            $count = Feedback::where('rating', $i)->count();
            $distribution[$i] = $total > 0 ? round(($count / $total) * 100) : 0;
        }

        return $distribution;
    }

    public function getPaymentData(Request $request)
    {
        try {
            $query = Pembayaran::with(['tiket.jadwal.kapal', 'tiket.penumpang', 'user']);

            // Filter by status
            if ($request->has('status') && $request->status !== 'all') {
                $query->where('status', $request->status);
            }

            // Search functionality
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->whereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('nama', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
                    })->orWhere('id', 'like', "%{$search}%");
                });
            }

            $payments = $query->orderBy('created_at', 'desc')->paginate(15);

            // Calculate statistics
            $stats = [
                'total' => Pembayaran::count(),
                'pending' => Pembayaran::where('status', 'menunggu')->count(),
                'verified' => Pembayaran::where('status', 'terverifikasi')->count(),
                'rejected' => Pembayaran::where('status', 'ditolak')->count(),
                'canceled' => Pembayaran::where('status', 'dibatalkan')->count(),
            ];

            return response()->json([
                'success' => true,
                'data' => $payments->items(),
                'current_page' => $payments->currentPage(),
                'last_page' => $payments->lastPage(),
                'per_page' => $payments->perPage(),
                'total' => $payments->total(),
                'from' => $payments->firstItem(),
                'to' => $payments->lastItem(),
                'stats' => $stats,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

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
