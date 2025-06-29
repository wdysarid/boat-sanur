<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Feedback;
use App\Models\Penumpang;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

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
            $query = Feedback::with(['user']);

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

    public function indexPassengers()
    {
        return view('admin.passengers');
    }

    public function getPassengerData(Request $request)
    {
        try {
            $query = Penumpang::with(['tiket.jadwal.kapal', 'user'])
                ->select('penumpang.*')
                ->join('tiket', 'tiket.id', '=', 'penumpang.tiket_id')
                ->join('jadwal', 'jadwal.id', '=', 'tiket.jadwal_id');

            // Apply filters
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('penumpang.nama_lengkap', 'like', "%{$search}%")
                      ->orWhere('penumpang.no_identitas', 'like', "%{$search}%")
                      ->orWhere('tiket.kode_pemesanan', 'like', "%{$search}%");
                });
            }

            if ($request->has('status') && $request->status !== 'all' && !empty($request->status)) {
                $query->where('penumpang.status', $request->status);
            }

            if ($request->has('jadwal_id') && !empty($request->jadwal_id)) {
                $query->where('tiket.jadwal_id', $request->jadwal_id);
            }

            if ($request->has('date') && !empty($request->date)) {
                $query->whereDate('jadwal.tanggal', $request->date);
            }

            // Pagination
            $perPage = 15;
            $penumpang = $query->orderBy('penumpang.created_at', 'desc')
                              ->paginate($perPage);

            // Get stats for dashboard
            $stats = [
                'total' => Penumpang::count(),
                'booked' => Penumpang::where('status', 'booked')->count(),
                'checked_in' => Penumpang::where('status', 'checked_in')->count(),
                'boarded' => Penumpang::where('status', 'boarded')->count(),
                'completed' => Penumpang::where('status', 'completed')->count(),
                'cancelled' => Penumpang::where('status', 'cancelled')->count(),
            ];

            return response()->json([
                'success' => true,
                'data' => $penumpang,
                'stats' => $stats
            ]);

        } catch (\Exception $e) {
            Log::error('Error loading passenger data', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data penumpang: ' . $e->getMessage()
            ], 500);
        }
    }

    public function showPassenger($id)
    {
        return view('admin.show', ['id' => $id]);
    }

    public function getPassengerDetail($id)
    {
        try {
            $penumpang = Penumpang::with([
                    'tiket.jadwal.kapal',
                    'tiket.pembayaran',
                    'user'
                ])
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $penumpang
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Penumpang tidak ditemukan: ' . $e->getMessage()
            ], 404);
        }
    }

    public function getJadwalOptions()
    {
        try {
            $jadwals = Jadwal::where('tanggal', '>=', now()->format('Y-m-d'))
                ->orderBy('tanggal', 'asc')
                ->get(['id', 'rute_asal', 'rute_tujuan', 'tanggal', 'waktu_berangkat']);

            return response()->json([
                'success' => true,
                'data' => $jadwals
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data jadwal'
            ], 500);
        }
    }

    /**
     * Check-in passenger via admin interface
     */
    public function checkInPassenger(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tiket_id' => 'required|exists:tiket,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Use the API controller method
            $apiRequest = new Request();
            $apiRequest->merge(['tiket_id' => $request->tiket_id]);

            $penumpangController = new \App\Http\Controllers\Api\PenumpangController();
            return $penumpangController->checkInPenumpang($apiRequest);

        } catch (\Exception $e) {
            Log::error('Admin check-in error', [
                'error' => $e->getMessage(),
                'tiket_id' => $request->tiket_id
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal melakukan check-in: ' . $e->getMessage()
            ], 500);
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
