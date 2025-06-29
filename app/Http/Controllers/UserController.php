<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tiket;
use App\Models\Jadwal;
use App\Models\Feedback;
use App\Models\Penumpang;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use App\Services\QrCodeService;

class UserController extends Controller
{
    private $apiUrl;
    protected $qrCodeService;

    public function __construct(QrCodeService $qrCodeService)
    {
        $this->apiUrl = env('APP_API_URL', 'http://localhost:8000/api');
        $this->qrCodeService = $qrCodeService;
    }

    // EXISTING FUNCTION - tidak diubah
    public function showProfile()
    {
        return view('wisatawan.profile', [
            'user' => auth()->user(),
        ]);
    }

    // EXISTING FUNCTION - tidak diubah
    public function updateProfile(Request $request)
    {
        try {
            $user = auth()->user();

            $validator = Validator::make(
                $request->all(),
                [
                    'nama' => 'required|string|min:2|max:255',
                    'email' => ['required', 'email', 'max:255', 'unique:user,email,' . $user->id . ',id'],
                    'no_telp' => 'nullable|string|max:20|regex:/^[0-9+\-\s]+$/',
                    'foto_user' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'remove_photo' => 'sometimes|boolean',
                ],
                [
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

            if ($request->input('remove_photo') == '1') {
                if ($user->foto_user && Storage::disk('public')->exists($user->foto_user)) {
                    Storage::disk('public')->delete($user->foto_user);
                }
                $validated['foto_user'] = null;
            } elseif ($request->hasFile('foto_user')) {
                if ($user->foto_user && Storage::disk('public')->exists($user->foto_user)) {
                    Storage::disk('public')->delete($user->foto_user);
                }

                $file = $request->file('foto_user');
                $filename = 'profile_' . time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('profile_photos', $filename, 'public');
                $validated['foto_user'] = $path;
            }

            $updateData = [];

            if (isset($validated['nama'])) {
                $updateData['nama'] = $validated['nama'];
            }

            if (isset($validated['email'])) {
                $updateData['email'] = $validated['email'];
            }

            if (array_key_exists('no_telp', $validated)) {
                $updateData['no_telp'] = $validated['no_telp'] ?? '';
            }

            if (array_key_exists('foto_user', $validated)) {
                $updateData['foto_user'] = $validated['foto_user'];
            }

            $user->update($updateData);
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

    // EXISTING FUNCTION - tidak diubah
    public function changePassword(Request $request)
    {
        try {
            $user = auth()->user();

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

            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Password saat ini tidak benar dan mungkin merupakan akun Google',
                        'errors' => [
                            'current_password' => ['Password saat ini tidak benar dan mungkin merupakan akun Google'],
                        ],
                    ],
                    422,
                );
            }

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

            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

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

    // EXISTING FUNCTION - tidak diubah
    public function feedbackForm()
    {
        return view('wisatawan.feedback-form')->with([
            'token' => session('token'),
        ]);
    }

    // EXISTING FUNCTION - tidak diubah
    public function tambahFeedback(Request $request)
    {
        $existingFeedback = Feedback::where('user_id', auth()->id())->first();

        if ($existingFeedback) {
            return back()->with('error', 'Anda sudah memberikan feedback sebelumnya.');
        }

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

    // MODIFIKASI: Pemesanan dengan fitur booking redirect
    public function pemesanan(Request $request)
    {
        try {
            // PERUBAHAN: Prioritaskan parameter dari URL, fallback ke session jika ada
            $jadwalId = $request->query('jadwal_id');

            // FITUR BARU: Jika tidak ada jadwal_id di URL, cek session booking_intent
            if (!$jadwalId) {
                $bookingIntent = session('booking_intent');
                if ($bookingIntent && isset($bookingIntent['jadwal_id'])) {
                    $jadwalId = $bookingIntent['jadwal_id'];
                    // Merge session data dengan request untuk view
                    $request->merge($bookingIntent);
                    // PENTING: Clear session setelah digunakan untuk mencegah konflik
                    session()->forget('booking_intent');
                }
            }

            if (!$jadwalId) {
                return view('wisatawan.pemesanan', [
                    'ticket' => null,
                    'searchParams' => $request->only(['from', 'to', 'departure_date', 'passenger_count', 'passenger_type']),
                ]);
            }

            // Coba ambil dari database lokal dulu
            $jadwal = Jadwal::with(['kapal'])->find($jadwalId);

            if (!$jadwal) {
                // Jika tidak ada di database lokal, coba via API
                $response = $this->apiRequest('GET', '/jadwal/' . $jadwalId);

                if (!$response['success'] || !isset($response['data'])) {
                    throw new \Exception('Gagal memuat data jadwal');
                }

                $jadwal = $response['data'];

                // Format data API ke format yang diharapkan view
                $formattedJadwal = [
                    'id' => $jadwal['id'],
                    'kapal' => [
                        'nama_kapal' => $jadwal['kapal']['nama_kapal'] ?? 'Fast Boat',
                        'foto_kapal' => $jadwal['kapal']['foto_kapal'] ?? null,
                    ],
                    'waktu_berangkat' => $jadwal['waktu_berangkat'],
                    'waktu_tiba' => $jadwal['waktu_tiba'],
                    'harga_tiket' => $jadwal['harga_tiket'],
                    'rute_asal' => $jadwal['rute_asal'],
                    'rute_tujuan' => $jadwal['rute_tujuan'],
                    'tanggal' => $jadwal['tanggal'],
                ];

                $jadwal = (object) $formattedJadwal;
            }

            return view('wisatawan.pemesanan', [
                'ticket' => [
                    'id' => $jadwal->id,
                    'boat_name' => $jadwal->kapal->nama_kapal ?? 'Fast Boat',
                    'image' => $jadwal->kapal->foto_kapal ? '/storage/' . $jadwal->kapal->foto_kapal : '/images/boats/default-boat.jpg',
                    'departure_time' => $jadwal->waktu_berangkat,
                    'arrival_time' => $jadwal->waktu_tiba,
                    'price' => $jadwal->harga_tiket,
                    'duration' => $this->calculateDuration($jadwal->waktu_berangkat, $jadwal->waktu_tiba),
                    'rute_asal' => $jadwal->rute_asal,
                    'rute_tujuan' => $jadwal->rute_tujuan,
                    'tanggal' => $jadwal->tanggal,
                ],
                'searchParams' => $request->only(['from', 'to', 'departure_date', 'passenger_count', 'passenger_type']),
            ]);
        } catch (\Exception $e) {
            logger()->error('Error loading schedule data', [
                'error' => $e->getMessage(),
                'jadwal_id' => $request->query('jadwal_id'),
                'user_id' => auth()->id(),
            ]);

            return redirect()
                ->route('search.tickets', $request->only(['from', 'to', 'departure_date']))
                ->with('error', 'Gagal memuat data jadwal. Silakan coba lagi atau pilih jadwal lain.');
        }
    }

    // EXISTING FUNCTION - tidak diubah
    private function calculateDuration($departure, $arrival)
    {
        $departureTime = Carbon::parse($departure);
        $arrivalTime = Carbon::parse($arrival);
        $duration = $departureTime->diff($arrivalTime);

        return $duration->h > 0 ? $duration->h . ' jam ' . $duration->i . ' menit' : $duration->i . ' menit';
    }

    // EXISTING FUNCTION - tidak diubah
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
            $totalHarga = $jadwal->harga_tiket * $request->passenger_count + 5000;

            $tiket = Tiket::create([
                'user_id' => auth()->id(),
                'jadwal_id' => $request->jadwal_id,
                'kode_pemesanan' => 'TKT-' . strtoupper(uniqid()),
                'jumlah_penumpang' => $request->passenger_count,
                'total_harga' => $totalHarga,
                'status' => Tiket::STATUS_MENUNGGU,
            ]);

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

            if ($request->has('passengers')) {
                foreach ($request->passengers as $passenger) {
                    $penumpangData[] = [
                        'tiket_id' => $tiket->id,
                        'user_id' => null,
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

    // EXISTING FUNCTION - tidak diubah
    public function pembayaran(Request $request)
    {
        try {
            $user = $request->user();

            // Cari tiket aktif yang menunggu pembayaran
            $tiket = Tiket::with(['jadwal.kapal', 'pembayaran'])
                ->where('user_id', $user->id)
                ->where('status', 'menunggu')
                ->where(function ($query) {
                    $query->whereDoesntHave('pembayaran')->orWhereHas('pembayaran', function ($q) {
                        $q->where('status', 'menunggu')->where(function ($q2) {
                            $q2->whereNull('expires_at')->orWhere('expires_at', '>', now());
                        });
                    });
                })
                ->latest()
                ->first();

            if (!$tiket) {
                return view('wisatawan.pembayaran', [
                    'tiket' => null,
                    'hasActivePayment' => false,
                ]);
            }

            // Cek atau buat pembayaran
            $pembayaran = $tiket->pembayaran()->where('status', 'menunggu')->first();

            if (!$pembayaran) {
                $pembayaran = Pembayaran::create([
                    'tiket_id' => $tiket->id,
                    'metode_bayar' => 'transfer',
                    'jumlah_bayar' => $tiket->total_harga,
                    'status' => 'menunggu',
                    'expires_at' => now()->addMinutes(15),
                ]);
            }
            // Jika sudah ada pembayaran tapi belum ada expires_at
            elseif (!$pembayaran->expires_at) {
                $pembayaran->update(['expires_at' => now()->addMinutes(15)]);
            }

            // Hitung sisa waktu dalam detik
            $remainingSeconds = $pembayaran->expires_at ? max(0, now()->diffInSeconds($pembayaran->expires_at, false)) : 900;

            return view('wisatawan.pembayaran', [
                'tiket' => $this->formatTiketData($tiket),
                'pembayaran' => $pembayaran,
                'remainingSeconds' => $remainingSeconds,
                'hasActivePayment' => true,
            ]);
        } catch (\Exception $e) {
            logger()->error('Payment page error', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return view('wisatawan.pembayaran', [
                'tiket' => null,
                'hasActivePayment' => false,
                'error' => 'Terjadi kesalahan saat memuat halaman pembayaran.',
            ]);
        }
    }

    // EXISTING FUNCTION - tidak diubah
    private function formatTiketData($tiket)
    {
        $biaya_admin = 5000;
        $total_harga = $tiket->jadwal->harga_tiket * $tiket->jumlah_penumpang + $biaya_admin;

        return [
            'id' => $tiket->id,
            'kode_pemesanan' => $tiket->kode_pemesanan,
            'rute_asal' => $tiket->jadwal->rute_asal,
            'rute_tujuan' => $tiket->jadwal->rute_tujuan,
            'tanggal' => $tiket->jadwal->tanggal,
            'jumlah_penumpang' => $tiket->jumlah_penumpang,
            'harga_tiket' => $tiket->jadwal->harga_tiket,
            'biaya_admin' => $biaya_admin,
            'total_harga' => $total_harga,
            'status' => $tiket->status,
            'jadwal' => [
                'waktu_berangkat' => $tiket->jadwal->waktu_berangkat,
                'waktu_tiba' => $tiket->jadwal->waktu_tiba,
                'kapal' => $tiket->jadwal->kapal->nama_kapal,
            ],
        ];
    }

    // EXISTING FUNCTION - tidak diubah
    public function prosesPembayaran(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'tiket_id' => 'required|exists:tiket,id',
                'metode_bayar' => 'required|in:transfer,qris',
                'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'payment_terms' => 'required|accepted',
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

            $user = $request->user();
            $tiket = Tiket::where('id', $request->tiket_id)->where('user_id', $user->id)->firstOrFail();

            // Validasi status tiket
            if (!in_array($tiket->status, [Tiket::STATUS_MENUNGGU, Tiket::STATUS_DIPROSES])) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Tiket tidak valid untuk pembayaran. Status tiket: ' . $tiket->status,
                    ],
                    400,
                );
            }

            // Upload bukti pembayaran
            $file = $request->file('bukti_transfer');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

            // Simpan file ke storage/public/bukti_pembayaran
            $path = $file->storeAs('bukti_pembayaran', $filename, 'public');

            if (!$path) {
                throw new \Exception('Gagal menyimpan bukti transfer');
            }

            // Update atau buat pembayaran
            $pembayaran = $tiket
                ->pembayaran()
                ->whereIn('status', [Pembayaran::STATUS_MENUNGGU, Pembayaran::STATUS_DITOLAK])
                ->first();

            if ($pembayaran) {
                $pembayaran->update([
                    'metode_bayar' => $request->metode_bayar,
                    'bukti_transfer' => $path,
                    'status' => Pembayaran::STATUS_MENUNGGU, // Reset status jika sebelumnya ditolak
                    'expires_at' => now()->addMinutes(15), // Reset waktu kadaluarsa
                ]);
            } else {
                $pembayaran = Pembayaran::create([
                    'tiket_id' => $tiket->id,
                    'metode_bayar' => $request->metode_bayar,
                    'jumlah_bayar' => $tiket->total_harga,
                    'bukti_transfer' => $path,
                    'status' => Pembayaran::STATUS_MENUNGGU,
                    'expires_at' => now()->addMinutes(15),
                ]);
            }

            // Update status tiket
            $tiket->update(['status' => Tiket::STATUS_DIPROSES]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil diproses. Menunggu verifikasi admin.',
                'redirect' => route('wisatawan.konfirmasi', ['tiket_id' => $tiket->id]),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Payment processing error', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    // EXISTING FUNCTION - tidak diubah
    public function konfirmasi(Request $request)
    {
        try {
            $user = $request->user();

            // Cari tiket terbaru yang sudah sukses atau masih menunggu pembayaran
            $tiket = Tiket::with(['jadwal', 'pembayaran'])
                ->where('user_id', $user->id)
                ->whereIn('status', ['sukses', 'diproses'])
                ->latest()
                ->first();

            if (!$tiket) {
                return view('wisatawan.konfirmasi', [
                    'tiket' => null,
                ]);
            }

            return view('wisatawan.konfirmasi', [
                'tiket' => $tiket,
            ]);
        } catch (\Exception $e) {
            logger()->error('Konfirmasi page error', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return view('wisatawan.konfirmasi', [
                'tiket' => null,
                'error' => 'Terjadi kesalahan saat memuat halaman konfirmasi.',
            ]);
        }
    }

    // EXISTING FUNCTION - tidak diubah
    public function tiketSaya()
    {
        try {
            $userId = auth()->id();

            $tickets = Tiket::with(['jadwal.kapal', 'pembayaran', 'penumpang'])
                ->where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('wisatawan.tiket', [
                'tickets' => $tickets,
                'stats' => $this->calculateTicketStats($tickets),
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching tickets: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memuat data tiket');
        }
    }

    // EXISTING FUNCTION - tidak diubah
    public function getTiketByStatus(Request $request, $status)
    {
        try {
            $userId = auth()->id();

            // PERBAIKAN: Selalu mulai dengan filter user_id untuk keamanan
            $query = Tiket::with(['jadwal.kapal', 'pembayaran', 'penumpang'])->where('user_id', $userId);

            switch ($status) {
                case 'upcoming':
                    // Tiket sukses dengan pembayaran terverifikasi dan tanggal >= hari ini
                    $query
                        ->where('status', 'sukses')
                        ->whereHas('pembayaran', function ($q) {
                            $q->where('status', 'terverifikasi');
                        })
                        ->whereHas('jadwal', function ($q) {
                            $q->where('tanggal', '>=', now()->format('Y-m-d'));
                        });
                    break;

                case 'pending':
                    // PERBAIKAN: Logika pending yang benar
                    $query->where(function ($q) {
                        // Tiket dengan status menunggu atau diproses
                        $q->where('status', 'menunggu')
                            ->orWhere('status', 'diproses')
                            // ATAU tiket sukses tapi pembayaran masih menunggu
                            ->orWhere(function ($q2) {
                                $q2->where('status', 'sukses')->whereHas('pembayaran', function ($q3) {
                                    $q3->where('status', 'menunggu');
                                });
                            });
                    });
                    break;

                case 'completed':
                    $query->where(function ($q) {
                        // Tiket sukses yang sudah lewat tanggalnya
                        $q->where(function ($q2) {
                            $q2->where('status', 'sukses')
                                ->whereHas('pembayaran', function ($q3) {
                                    $q3->where('status', 'terverifikasi');
                                })
                                ->whereHas('jadwal', function ($q4) {
                                    $q4->where('tanggal', '<', now()->format('Y-m-d'));
                                });
                        })
                            // Atau tiket yang dibatalkan/ditolak
                            ->orWhere('status', 'dibatalkan')
                            ->orWhereHas('pembayaran', function ($q5) {
                                $q5->where('status', 'ditolak');
                            });
                    });
                    break;

                default:
                    // 'all'
                    // Tampilkan semua tiket
                    break;
            }

            $tickets = $query->orderBy('created_at', 'desc')->get();

            // Hitung statistik
            $allTickets = Tiket::with(['jadwal.kapal', 'pembayaran'])
                ->where('user_id', $userId)
                ->get();

            $stats = $this->calculateTicketStats($allTickets);

            return response()->json([
                'success' => true,
                'data' => $tickets,
                'stats' => $stats,
            ]);
        } catch (\Exception $e) {
            Log::error('Error filtering tickets by status: ' . $e->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Gagal memuat data tiket: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    // EXISTING FUNCTION - tidak diubah
    private function calculateTicketStats($tickets)
    {
        $total = $tickets->count();
        $upcoming = 0;
        $pending = 0;
        $completed = 0;

        foreach ($tickets as $ticket) {
            // PERBAIKAN: Logika pending yang konsisten
            if ($ticket->status === 'menunggu' || $ticket->status === 'diproses') {
                $pending++;
            } elseif ($ticket->status === 'sukses') {
                if ($ticket->pembayaran && $ticket->pembayaran->status === 'menunggu') {
                    // PERBAIKAN: Tiket sukses tapi pembayaran menunggu = pending
                    $pending++;
                } elseif ($ticket->pembayaran && $ticket->pembayaran->status === 'terverifikasi') {
                    $ticketDate = Carbon::parse($ticket->jadwal->tanggal);
                    if ($ticketDate->gte(now()->startOfDay())) {
                        $upcoming++;
                    } else {
                        $completed++;
                    }
                } else {
                    // Tiket sukses tapi tidak ada pembayaran atau status pembayaran lain
                    $pending++;
                }
            } elseif ($ticket->status === 'dibatalkan' || ($ticket->pembayaran && $ticket->pembayaran->status === 'ditolak')) {
                $completed++;
            }
        }

        return [
            'total' => $total,
            'upcoming' => $upcoming,
            'pending' => $pending,
            'completed' => $completed,
        ];
    }

    // EXISTING FUNCTION - tidak diubah
    public function getTiketDetail($id)
    {
        try {
            Log::info('Getting ticket detail', ['ticket_id' => $id, 'user_id' => auth()->id()]);

            $ticket = Tiket::with(['jadwal.kapal', 'pembayaran', 'penumpang'])
                ->where('user_id', auth()->id())
                ->find($id);

            if (!$ticket) {
                Log::warning('Ticket not found or access denied', [
                    'ticket_id' => $id,
                    'user_id' => auth()->id(),
                ]);

                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Tiket tidak ditemukan atau Anda tidak memiliki akses',
                    ],
                    404,
                );
            }

            // Tambahkan URL bukti transfer jika ada
            if ($ticket->pembayaran && $ticket->pembayaran->bukti_transfer) {
                $ticket->pembayaran->bukti_transfer_url = asset('storage/' . $ticket->pembayaran->bukti_transfer);
            }

            // PERBAIKAN: Generate QR Code sederhana jika tiket sudah dikonfirmasi
            $qrCodeData = null;

            try {
                if ($ticket->status === 'sukses' && $ticket->pembayaran && $ticket->pembayaran->status === 'terverifikasi') {
                    Log::info('Generating simple QR Code for confirmed ticket', ['ticket_id' => $id]);

                    // PERBAIKAN: QR Data sederhana - hanya kode pemesanan
                    $qrData = $ticket->kode_pemesanan; // Format: "TKT-ABC123"

                    // Generate QR Code sebagai data URI untuk modal
                    $qrCodeData = $this->qrCodeService->generateQrCode($qrData, 200);

                    Log::info('Simple QR Code generated successfully for modal', [
                        'ticket_id' => $id,
                        'qr_data' => $qrData
                    ]);
                }
            } catch (\Exception $qrError) {
                Log::error('Error generating simple QR Code for modal', [
                    'ticket_id' => $id,
                    'error' => $qrError->getMessage(),
                    'trace' => $qrError->getTraceAsString(),
                ]);

                // Jangan gagalkan seluruh request jika QR Code gagal
                $qrCodeData = null;
            }

            Log::info('Ticket detail retrieved successfully', ['ticket_id' => $id]);

            return response()->json([
                'success' => true,
                'data' => $ticket,
                'qr_code' => $qrCodeData,
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting ticket detail', [
                'ticket_id' => $id,
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat memuat detail tiket: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    // EXISTING FUNCTION - tidak diubah
    public function showTiket($id)
    {
        try {
            $ticket = Tiket::with(['jadwal.kapal', 'pembayaran', 'penumpang'])
                ->where('user_id', auth()->id())
                ->findOrFail($id);

            return view('wisatawan.tiket-detail', [
                'ticket' => $ticket,
            ]);
        } catch (\Exception $e) {
            Log::error('Error showing ticket: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Tiket tidak ditemukan');
        }
    }

    // EXISTING FUNCTION - tidak diubah
    public function batalkanTiket(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = $request->user();

            // Validasi user
            if (!$user) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Anda harus login untuk membatalkan tiket',
                    ],
                    401,
                );
            }

            // Cari tiket dengan relasi pembayaran
            $tiket = Tiket::with('pembayaran')->where('id', $id)->where('user_id', $user->id)->first();

            if (!$tiket) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Tiket tidak ditemukan atau Anda tidak memiliki akses',
                    ],
                    404,
                );
            }

            // Validasi status tiket
            $allowedStatuses = ['menunggu', 'diproses'];
            if (!in_array($tiket->status, $allowedStatuses)) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Tiket tidak dapat dibatalkan karena status sudah ' . $tiket->status,
                    ],
                    400,
                );
            }

            // Update status tiket
            $tiket->update(['status' => 'dibatalkan']);

            // Jika ada pembayaran yang masih menunggu, batalkan juga
            if ($tiket->pembayaran && $tiket->pembayaran->status === 'menunggu') {
                $tiket->pembayaran->update([
                    'status' => 'dibatalkan',
                    'expires_at' => now(),
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Tiket berhasil dibatalkan',
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

    // EXISTING FUNCTION - tidak diubah (PERBAIKAN SYNTAX ERROR)
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
