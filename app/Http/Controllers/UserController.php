<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tiket;
use App\Models\Jadwal;
use App\Models\Feedback;
use App\Models\Penumpang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

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

            // PERBAIKAN: Validasi sesuai dengan frontend (hanya nama dan email required)
            $validator = Validator::make(
                $request->all(),
                [
                    'nama' => 'required|string|min:2|max:255',
                    'email' => ['required', 'email', 'max:255', 'unique:user,email,' . $user->id . ',id'],
                    'no_telp' => 'nullable|string|max:20|regex:/^[0-9+\-\s]+$/', // OPTIONAL dan dengan regex pattern
                    'foto_user' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'remove_photo' => 'sometimes|boolean',
                ],
                [
                    // Custom error messages dalam bahasa Indonesia
                    'nama.required' => 'Nama lengkap wajib diisi',
                    'nama.min' => 'Nama lengkap minimal 2 karakter',
                    'nama.max' => 'Nama lengkap maksimal 255 karakter',
                    'email.required' => 'Email wajib diisi',
                    'email.email' => 'Format email tidak valid',
                    'email.unique' => 'Email sudah digunakan oleh pengguna lain',
                    'email.max' => 'Email maksimal 255 karakter',
                    'no_telp.max' => 'Nomor telepon maksimal 20 karakter',
                    'no_telp.regex' => 'Format nomor telepon tidak valid (hanya angka, +, -, dan spasi)',
                    'foto_user.image' => 'File harus berupa gambar',
                    'foto_user.mimes' => 'Format foto tidak didukung (hanya JPG, PNG, GIF)',
                    'foto_user.max' => 'Ukuran foto maksimal 2MB',
                ],
            );

            // PERBAIKAN: Return validation errors dalam format yang sesuai dengan frontend
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

            $validated = $validator->validated();

            // Handle photo removal
            if ($request->input('remove_photo') == '1') {
                // Hapus foto lama jika ada (tapi jangan hapus Google avatar)
                if ($user->foto_user && Storage::disk('public')->exists($user->foto_user)) {
                    Storage::disk('public')->delete($user->foto_user);
                }
                $validated['foto_user'] = null; // Set ke null untuk menghapus path foto
            }
            // Handle file upload
            elseif ($request->hasFile('foto_user')) {
                // Hapus foto lama jika ada (tapi jangan hapus Google avatar)
                if ($user->foto_user && Storage::disk('public')->exists($user->foto_user)) {
                    Storage::disk('public')->delete($user->foto_user);
                }

                $file = $request->file('foto_user');
                $filename = 'profile_' . time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('profile_photos', $filename, 'public');
                $validated['foto_user'] = $path;
            }

            // PERBAIKAN: Hanya update field yang ada dalam validated data
            $updateData = [];

            if (isset($validated['nama'])) {
                $updateData['nama'] = $validated['nama'];
            }

            if (isset($validated['email'])) {
                $updateData['email'] = $validated['email'];
            }

            // PERBAIKAN: Handle no_telp yang bisa kosong
            if (array_key_exists('no_telp', $validated)) {
                $updateData['no_telp'] = $validated['no_telp'] ?? '';
            }

            if (array_key_exists('foto_user', $validated)) {
                $updateData['foto_user'] = $validated['foto_user'];
            }

            $user->update($updateData);

            // PERBAIKAN: Refresh user data untuk response
            $user->refresh();

            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil diperbarui',
                'user' => $user,
            ]);
        } catch (ValidationException $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors(),
                ],
                422,
            );
        } catch (\Exception $e) {
            // Log error untuk debugging
            logger()->error('Profile update error', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat memperbarui profil. Silakan coba lagi.',
                ],
                500,
            );
        }
    }

    /**
     * BARU: Handle change password
     */
    public function changePassword(Request $request)
    {
        try {
            $user = auth()->user();

            // Cek apakah user login dengan Google (tidak punya password)
            if ($user->google_id && !$user->password) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Akun Anda terdaftar melalui Google. Tidak dapat mengubah password.',
                    ],
                    400,
                );
            }

            $validator = Validator::make(
                $request->all(),
                [
                    'current_password' => 'required|string',
                    'new_password' => ['required', 'string', 'min:6', 'confirmed', Password::min(6)->mixedCase()->numbers()->symbols()->uncompromised()],
                    'new_password_confirmation' => 'required|string',
                ],
                [
                    'current_password.required' => 'Password saat ini wajib diisi',
                    'new_password.required' => 'Password baru wajib diisi',
                    'new_password.min' => 'Password baru minimal 6 karakter',
                    'new_password.confirmed' => 'Konfirmasi password tidak cocok',
                    'new_password_confirmation.required' => 'Konfirmasi password wajib diisi',
                ],
            );

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

            // Cek password saat ini
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Password saat ini tidak benar',
                        'errors' => [
                            'current_password' => ['Password saat ini tidak benar'],
                        ],
                    ],
                    422,
                );
            }

            // Cek apakah password baru sama dengan password lama
            if (Hash::check($request->new_password, $user->password)) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Password baru tidak boleh sama dengan password saat ini',
                        'errors' => [
                            'new_password' => ['Password baru tidak boleh sama dengan password saat ini'],
                        ],
                    ],
                    422,
                );
            }

            // Update password
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            // Log activity
            logger()->info('Password changed successfully', [
                'user_id' => $user->id,
                'email' => $user->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Password berhasil diubah',
            ]);
        } catch (ValidationException $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors(),
                ],
                422,
            );
        } catch (\Exception $e) {
            logger()->error('Change password error', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat mengubah password. Silakan coba lagi.',
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
        $validator = Validator::make(
            $request->all(),
            [
                'pesan' => 'required|string|max:500',
                'rating' => 'required|integer|between:1,5',
            ],
            [
                'pesan.required' => 'Pesan feedback wajib diisi',
                'pesan.max' => 'Pesan feedback maksimal 500 karakter',
                'rating.required' => 'Rating wajib dipilih',
                'rating.integer' => 'Rating harus berupa angka',
                'rating.between' => 'Rating harus antara 1-5',
            ],
        );

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

            logger()->info('Feedback created successfully', [
                'user_id' => auth()->id(),
                'feedback_id' => $feedback->id,
                'rating' => $request->rating,
            ]);

            return back()->with('success', 'Feedback berhasil dikirim!');
        } catch (\Exception $e) {
            logger()->error('Feedback submission error', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return back()->with('error', 'Terjadi kesalahan saat mengirim feedback');
        }
    }

    public function pemesanan(Request $request)
    {
        try {
            $jadwalId = $request->query('jadwal_id');

            // if (!$jadwalId) {
            //     return redirect()->route('wisatawan.dashboard')->with('error', 'Jadwal tidak valid');
            // }
            if (!$jadwalId) {
                return view('wisatawan.pemesanan', [
                    'ticket' => null,
                    'searchParams' => $request->only(['from', 'to', 'departure_date', 'passenger_count', 'passenger_type']),
                ]);
            }

            // Dapatkan data jadwal dari API
            $response = $this->apiRequest('GET', '/jadwal/' . $jadwalId);

            if (!$response['success']) {
                return redirect()->route('wisatawan.dashboard')->with('error', 'Gagal memuat data jadwal');
            }

            $jadwal = $response['data'];

            return view('wisatawan.pemesanan', [
                'ticket' => [
                    'id' => $jadwal['id'],
                    'boat_name' => $jadwal['kapal']['nama_kapal'] ?? 'Fast Boat',
                    'image' => $jadwal['kapal']['foto_kapal'] ? '/storage/' . $jadwal['kapal']['foto_kapal'] : '/images/boats/default-boat.jpg',
                    'departure_time' => $jadwal['waktu_berangkat'],
                    'arrival_time' => $jadwal['waktu_tiba'],
                    'price' => $jadwal['harga_tiket'],
                    'duration' => $this->calculateDuration($jadwal['waktu_berangkat'], $jadwal['waktu_tiba']),
                ],
                'searchParams' => $request->only(['from', 'to', 'departure_date', 'passenger_count', 'passenger_type']),
            ]);
        } catch (\Exception $e) {
            return redirect()
                ->route('wisatawan.dashboard')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function calculateDuration($departure, $arrival)
    {
        $departureTime = Carbon::parse($departure);
        $arrivalTime = Carbon::parse($arrival);
        $duration = $departureTime->diff($arrivalTime);

        return $duration->h > 0 ? $duration->h . ' jam ' . $duration->i . ' menit' : $duration->i . ' menit';
    }

    public function prosesPemesanan(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'jadwal_id' => 'required|exists:jadwal,id',
                    'departure_date' => 'required|date',
                    'from' => 'required|string',
                    'to' => 'required|string',
                    'passenger_count' => 'required|integer|min:1|max:10',
                    'nama_lengkap' => 'required|string|max:255',
                    'no_identitas' => 'required|string|max:50',
                    'usia' => 'required|integer|min:1|max:120',
                    'jenis_kelamin' => ['required', Rule::in(['laki-laki', 'perempuan'])],
                    'email' => 'required|email',
                    'no_telpon' => 'required|string',
                    'terms' => 'required|accepted',
                    'passengers' => 'nullable|array',
                    'passengers.*.nama_lengkap' => 'required_with:passengers|string|max:255',
                    'passengers.*.no_identitas' => 'required_with:passengers|string|max:50',
                    'passengers.*.usia' => 'required_with:passengers|integer|min:1|max:120',
                    'passengers.*.jenis_kelamin' => ['required_with:passengers', Rule::in(['laki-laki', 'perempuan'])],
                ],
                [
                    'passengers.*.nama_lengkap.required_with' => 'Nama lengkap penumpang tambahan wajib diisi',
                    'passengers.*.no_identitas.required_with' => 'Nomor identitas penumpang tambahan wajib diisi',
                    'passengers.*.usia.required_with' => 'Usia penumpang tambahan wajib diisi',
                    'passengers.*.jenis_kelamin.required_with' => 'Jenis kelamin penumpang tambahan wajib dipilih',
                ],
            );

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

            $jadwal = Jadwal::findOrFail($request->jadwal_id);
            $totalHarga = $jadwal->harga_tiket * $request->passenger_count + 5000; // + biaya admin

            // Buat tiket
            $tiket = Tiket::create([
                'user_id' => auth()->id(),
                'jadwal_id' => $request->jadwal_id,
                'kode_pemesanan' => 'TKT-' . strtoupper(uniqid()),
                'jumlah_penumpang' => $request->passenger_count,
                'total_harga' => $totalHarga,
                'status' => Tiket::STATUS_MENUNGGU,
            ]);

            // Simpan data penumpang utama (pemesan)
            $penumpangData = [
                [
                    'tiket_id' => $tiket->id,
                    'user_id' => auth()->id(),
                    'nama_lengkap' => $request->nama_lengkap,
                    'no_identitas' => $request->no_identitas,
                    'usia' => $request->usia,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'is_pemesan' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];

            // Tambahkan penumpang tambahan jika ada
            if ($request->has('passengers')) {
                foreach ($request->passengers as $passenger) {
                    $penumpangData[] = [
                        'tiket_id' => $tiket->id,
                        'user_id' => null, // Penumpang tambahan tidak punya user_id
                        'nama_lengkap' => $passenger['nama_lengkap'],
                        'no_identitas' => $passenger['no_identitas'],
                        'usia' => $passenger['usia'],
                        'jenis_kelamin' => $passenger['jenis_kelamin'],
                        'is_pemesan' => false,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            // Insert semua penumpang sekaligus
            Penumpang::insert($penumpangData);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pemesanan berhasil',
                'tiket_id' => $tiket->id,
                'redirect' => route('wisatawan.pembayaran', ['tiket_id' => $tiket->id]),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function pembayaran(Request $request)
    {
        try {
            $user = $request->user();
            $tiketId = $request->query('tiket_id');

            // Jika datang dari pemesanan dengan tiket_id
            if ($tiketId) {
                $tiket = Tiket::with(['jadwal.kapal', 'pembayaran'])
                            ->where('id', $tiketId)
                            ->where('user_id', $user->id)
                            ->firstOrFail();

                if ($tiket->status !== 'menunggu') {
                    return redirect()->route('wisatawan.tiket')->with('error', 'Tiket sudah diproses');
                }

                $pembayaran = $tiket->pembayaran ?? null;

                return view('wisatawan.pembayaran', [
                    'booking' => $this->formatBookingData($tiket),
                    'pembayaran' => $pembayaran
                ]);
            }

            // Jika datang dari dashboard, cari tiket terbaru yang menunggu pembayaran
            $tiket = Tiket::with(['jadwal.kapal', 'pembayaran'])
                        ->where('user_id', $user->id)
                        ->where('status', 'menunggu')
                        ->latest()
                        ->first();

            if (!$tiket) {
                // Tampilkan empty state
                return view('wisatawan.pembayaran', [
                    'booking' => null,
                    'pembayaran' => null
                ]);
            }

            return view('wisatawan.pembayaran', [
                'booking' => $this->formatBookingData($tiket),
                'pembayaran' => $tiket->pembayaran
            ]);

        } catch (\Exception $e) {
            return redirect()->route('wisatawan.dashboard')
                ->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    private function formatBookingData($tiket)
    {
        $jadwal = $tiket->jadwal;

        return [
            'id' => $tiket->id,
            'kode_pemesanan' => $tiket->kode_pemesanan,
            'from' => $jadwal->rute_asal,
            'to' => $jadwal->rute_tujuan,
            'departure_date' => $jadwal->tanggal,
            'passenger_count' => $tiket->jumlah_penumpang,
            'ticket_price' => $jadwal->harga_tiket,
            'admin_fee' => 5000, // Biaya tetap
            'total_amount' => $tiket->total_harga,
            'status' => $tiket->status,
            'jadwal' => [
                'waktu_berangkat' => $jadwal->waktu_berangkat,
                'waktu_tiba' => $jadwal->waktu_tiba,
                'kapal' => $jadwal->kapal->nama_kapal
            ]
        ];
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
            logger()->error('API request error', [
                'method' => $method,
                'url' => $url,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'message' => 'Error connecting to API: ' . $e->getMessage(),
            ];
        }
    }
}
