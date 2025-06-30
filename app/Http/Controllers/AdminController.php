<?php

namespace App\Http\Controllers;

use App\Models\Kapal;
use App\Models\Tiket;
use App\Models\Jadwal;
use App\Models\Feedback;
use App\Models\Penumpang;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Services\QrCodeService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    private $apiUrl;
    protected $qrCodeService;

    public function __construct(QrCodeService $qrCodeService)
    {
        $this->apiUrl = env('APP_API_URL', 'http://localhost:8000/api');
        $this->qrCodeService = $qrCodeService;
    }

    public function dashboard()
    {
        // Kapal aktif
        $activeBoatsCount = Kapal::where('status', 'aktif')->count();
        $totalBoatsCount = Kapal::count();

        // Pendapatan bulan ini
        $monthlyRevenue = Pembayaran::where('status', 'terverifikasi')
            ->whereMonth('created_at', now()->month)
            ->sum('jumlah_bayar');

        // Total penumpang
        $totalPassengers = Penumpang::count();

        // Jadwal hari ini
        $todaySchedules = Jadwal::with(['kapal'])
            ->whereDate('tanggal', today())
            ->orderBy('waktu_berangkat')
            ->get()
            ->map(function($schedule) {
                $schedule->tiket_terjual = $schedule->tiket()->where('status', 'sukses')->sum('jumlah_penumpang');
                return $schedule;
            });

        $todaySchedulesCount = $todaySchedules->count();

        // Aktivitas hari ini
        $todayPassengers = Penumpang::whereDate('created_at', today())->count();
        $todayBookings = Tiket::whereDate('created_at', today())->count();
        $todayRevenue = Pembayaran::where('status', 'terverifikasi')
            ->whereDate('created_at', today())
            ->sum('jumlah_bayar');

        // SIMPLIFIED: Status penumpang - only 3 statuses
        $passengerStatuses = [
            'booked' => Penumpang::where('status', 'booked')->count(),
            'checked_in' => Penumpang::where('status', 'checked_in')->count(),
            'cancelled' => Penumpang::where('status', 'cancelled')->count(),
        ];

        return view('admin.dashboard', [
            'activeBoatsCount' => $activeBoatsCount,
            'totalBoatsCount' => $totalBoatsCount,
            'monthlyRevenue' => $monthlyRevenue,
            'totalPassengers' => $totalPassengers,
            'todaySchedules' => $todaySchedules,
            'todaySchedulesCount' => $todaySchedulesCount,
            'todayPassengers' => $todayPassengers,
            'todayBookings' => $todayBookings,
            'todayRevenue' => $todayRevenue,
            'passengerStatuses' => $passengerStatuses,
        ]);
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

    /**
     * FIXED: Get passenger data with proper validation and error handling
     */
    public function getPassengerData(Request $request)
    {
        try {
            // FIXED: More lenient validation - allow empty strings
            $validator = Validator::make($request->all(), [
                'search' => 'nullable|string|max:255',
                'status' => 'nullable|string|in:,all,booked,checked_in,cancelled', // Allow empty string and 'all'
                'jadwal_id' => 'nullable|string', // Allow empty string, will validate exists only if not empty
                'date' => 'nullable|date',
                'page' => 'nullable|integer|min:1',
            ]);

            if ($validator->fails()) {
                Log::error('Validation failed in getPassengerData', [
                    'errors' => $validator->errors()->toArray(),
                    'request_data' => $request->all()
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal: ' . $validator->errors()->first(),
                    'errors' => $validator->errors(),
                ], 422);
            }

            // FIXED: Build query with proper null checks
            $query = Penumpang::with([
                'tiket' => function ($q) {
                    $q->select('id', 'kode_pemesanan', 'jadwal_id', 'user_id', 'status', 'jumlah_penumpang', 'total_harga');
                },
                'tiket.jadwal' => function ($q) {
                    $q->select('id', 'rute_asal', 'rute_tujuan', 'tanggal', 'waktu_berangkat', 'kapal_id');
                },
                'tiket.jadwal.kapal' => function ($q) {
                    $q->select('id', 'nama_kapal');
                },
                'user' => function ($q) {
                    $q->select('id', 'nama', 'email');
                },
            ]);

            // Apply search filter
            if ($request->filled('search')) {
                $search = trim($request->search);
                $query->where(function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', "%{$search}%")
                        ->orWhere('no_identitas', 'like', "%{$search}%")
                        ->orWhereHas('tiket', function ($subQ) use ($search) {
                            $subQ->where('kode_pemesanan', 'like', "%{$search}%");
                        });
                });
            }

            // Apply status filter - FIXED: Handle empty strings and 'all'
            if ($request->filled('status') && $request->status !== 'all' && $request->status !== '') {
                $query->where('status', $request->status);
            }

            // Apply jadwal filter - FIXED: Validate exists only if not empty
            if ($request->filled('jadwal_id') && $request->jadwal_id !== '') {
                // Check if jadwal exists
                if (!\App\Models\Jadwal::where('id', $request->jadwal_id)->exists()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Jadwal tidak ditemukan',
                    ], 422);
                }

                $query->whereHas('tiket', function ($q) use ($request) {
                    $q->where('jadwal_id', $request->jadwal_id);
                });
            }

            // Apply date filter
            if ($request->filled('date')) {
                $query->whereHas('tiket.jadwal', function ($q) use ($request) {
                    $q->whereDate('tanggal', $request->date);
                });
            }

            // Get paginated results
            $perPage = 15;
            $penumpang = $query->orderBy('created_at', 'desc')->paginate($perPage);

            // Calculate stats
            $stats = [
                'total' => Penumpang::count(),
                'booked' => Penumpang::where('status', 'booked')->count(),
                'checked_in' => Penumpang::where('status', 'checked_in')->count(),
                'cancelled' => Penumpang::where('status', 'cancelled')->count(),
            ];

            return response()->json([
                'success' => true,
                'data' => $penumpang,
                'stats' => $stats,
            ]);

        } catch (\Exception $e) {
            Log::error('Error in getPassengerData', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data penumpang: ' . $e->getMessage(),
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    public function passengers()
    {
        return view('admin.passengers');
    }

    public function showPassenger($id)
    {
        return view('admin.show', ['passengerId' => $id]);
    }

    public function getPassengerDetail($id)
    {
        try {
            $passenger = Penumpang::with([
                'tiket' => function ($q) {
                    $q->select('id', 'kode_pemesanan', 'jadwal_id', 'user_id', 'status', 'jumlah_penumpang', 'total_harga', 'created_at');
                },
                'tiket.jadwal' => function ($q) {
                    $q->select('id', 'rute_asal', 'rute_tujuan', 'tanggal', 'waktu_berangkat', 'waktu_tiba', 'kapal_id');
                },
                'tiket.jadwal.kapal' => function ($q) {
                    $q->select('id', 'nama_kapal');
                },
                'tiket.pembayaran' => function ($q) {
                    $q->select('id', 'tiket_id', 'status', 'metode_bayar', 'jumlah_bayar', 'updated_at');
                },
                'user' => function ($q) {
                    $q->select('id', 'nama', 'email');
                },
            ])->find($id);

            if (!$passenger) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Penumpang tidak ditemukan',
                    ],
                    404,
                );
            }

            // Generate QR Code if ticket is valid
            $qrCodeData = null;
            if ($passenger->tiket && $passenger->tiket->kode_pemesanan) {
                try {
                    $qrData = $passenger->tiket->kode_pemesanan;
                    $qrCodeData = $this->qrCodeService->generateQrCode($qrData, 200);

                    Log::info('QR Code generated for passenger detail', [
                        'passenger_id' => $id,
                        'ticket_id' => $passenger->tiket->id,
                        'qr_data' => $qrData,
                    ]);
                } catch (\Exception $qrError) {
                    Log::error('Error generating QR Code for passenger detail', [
                        'passenger_id' => $id,
                        'error' => $qrError->getMessage(),
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'data' => $passenger,
                'qr_code' => $qrCodeData,
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting passenger detail', [
                'passenger_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Gagal memuat detail penumpang: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function getJadwalOptions()
    {
        try {
            $jadwal = Jadwal::select('id', 'rute_asal', 'rute_tujuan', 'tanggal', 'waktu_berangkat')
                ->where('tanggal', '>=', now()->format('Y-m-d'))
                ->orderBy('tanggal', 'asc')
                ->orderBy('waktu_berangkat', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $jadwal,
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting jadwal options: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat jadwal',
                'data' => [],
            ]);
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
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Validasi gagal',
                        'errors' => $validator->errors(),
                    ],
                    422,
                );
            }

            // Use the API controller method
            $apiRequest = new Request();
            $apiRequest->merge(['tiket_id' => $request->tiket_id]);

            $penumpangController = new \App\Http\Controllers\Api\PenumpangController();
            return $penumpangController->checkInPenumpang($apiRequest);
        } catch (\Exception $e) {
            Log::error('Admin check-in error', [
                'error' => $e->getMessage(),
                'tiket_id' => $request->tiket_id,
            ]);

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Gagal melakukan check-in: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function generateQrCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response('Invalid data', 400);
        }

        try {
            $qrData = $request->data;

            // Normalize format
            if (!str_starts_with($qrData, 'TKT-') && preg_match('/^[A-Z0-9]+$/', $qrData)) {
                $qrData = 'TKT-' . $qrData;
            }

            Log::info('Admin generating QR Code', [
                'original_data' => $request->data,
                'normalized_data' => $qrData,
            ]);

            $qrCodeDataUri = $this->qrCodeService->generateQrCode($qrData, 200);

            // Convert data URI to binary
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $qrCodeDataUri));

            return response($imageData)->header('Content-Type', 'image/png')->header('Cache-Control', 'public, max-age=3600');
        } catch (\Exception $e) {
            Log::error('Error generating QR Code for admin', [
                'data' => $request->data,
                'error' => $e->getMessage(),
            ]);

            return response('Error generating QR Code', 500);
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
