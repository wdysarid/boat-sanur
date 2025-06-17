<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Get all feedback (admin only)
     */
    public function getSemuaFeedback(Request $request)
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
                        $userQuery->where('nama', 'like', "%{$search}%")
                                 ->orWhere('email', 'like', "%{$search}%");
                    })->orWhere('pesan', 'like', "%{$search}%");
                });
            }

            // Paginate with 10 items per page
            $feedbacks = $query->orderBy('created_at', 'desc')->paginate(10);

            // Calculate statistics - ensure average_rating is always a number
            $approvedFeedbacks = Feedback::where('status', 'disetujui');
            $averageRating = $approvedFeedbacks->avg('rating');

            $stats = [
                'total' => Feedback::count(),
                'pending' => Feedback::where('status', 'pending')->count(),
                'approved' => $approvedFeedbacks->count(),
                'rejected' => Feedback::where('status', 'ditolak')->count(),
                'average_rating' => $averageRating ? (float) $averageRating : 0,
                'rating_distribution' => $this->getRatingDistribution(),
            ];

            return response()->json([
                'success' => true,
                'data' => $feedbacks->items(),
                'current_page' => $feedbacks->currentPage(),
                'last_page' => $feedbacks->lastPage(),
                'from' => $feedbacks->firstItem(),
                'to' => $feedbacks->lastItem(),
                'total' => $feedbacks->total(),
                'prev_page_url' => $feedbacks->previousPageUrl(),
                'next_page_url' => $feedbacks->nextPageUrl(),
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

    /**
     * Get approved feedback
     */
    public function getFeedbackDisetujui()
    {
        $feedback = Feedback::with('user')->where('status', 'disetujui')->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $feedback,
        ]);
    }

    /**
     * Add new feedback
     */
    public function tambahFeedback(Request $request)
    {
        // Cek authentication dengan web guard
        if (!Auth::check()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Unauthenticated',
                ],
                401,
            );
        }

        $validator = Validator::make($request->all(), [
            'pesan' => 'required|string|max:500',
            'rating' => 'required|integer|between:1,5',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        $feedback = Feedback::create([
            'user_id' => Auth::id(),
            'pesan' => $request->pesan,
            'rating' => $request->rating,
            'status' => 'pending',
        ]);

        return response()->json(
            [
                'success' => true,
                'data' => $feedback,
                'message' => 'Feedback dan rating berhasil dikirim!',
            ],
            201,
        );
    }

    /**
     * Get user's feedback
     */
    public function getFeedbackSaya(Request $request)
    {
        // Cek authentication
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        $feedback = Feedback::where('user_id', Auth::id())
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $feedback,
        ]);
    }

    /**
     * Update user's feedback
     */
    public function updateFeedback(Request $request, $id)
    {
        // Cek authentication
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        $feedback = Feedback::find($id);

        if (!$feedback) {
            return response()->json([
                'success' => false,
                'message' => 'Feedback tidak ditemukan',
            ], 404);
        }

        // Pastikan user hanya bisa update feedback miliknya sendiri
        if ($feedback->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk mengedit feedback ini.',
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'pesan' => 'required|string|max:500',
            'rating' => 'required|integer|between:1,5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $feedback->update([
            'pesan' => $request->pesan,
            'rating' => $request->rating,
            'status' => 'pending', // Reset status to pending after edit
        ]);

        return response()->json([
            'success' => true,
            'data' => $feedback,
            'message' => 'Feedback berhasil diperbarui',
        ]);
    }

    /**
     * Delete user's feedback
     */
    public function deleteFeedback(Request $request, $id)
    {
        // Cek authentication
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        $feedback = Feedback::find($id);

        if (!$feedback) {
            return response()->json([
                'success' => false,
                'message' => 'Feedback tidak ditemukan',
            ], 404);
        }

        // Pastikan user hanya bisa hapus feedback miliknya sendiri
        if ($feedback->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk menghapus feedback ini.',
            ], 403);
        }

        $feedback->delete();

        return response()->json([
            'success' => true,
            'message' => 'Feedback berhasil dihapus',
        ]);
    }

    /**
     * Approve/reject feedback (Admin)
     */
    public function handleStatus($id, $action)
    {
        $validActions = ['approve', 'reject'];

        if (!in_array($action, $validActions)) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Aksi tidak valid',
                ],
                400,
            );
        }

        $feedback = Feedback::find($id);

        if (!$feedback) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Feedback tidak ditemukan',
                ],
                404,
            );
        }

        $status = $action === 'approve' ? 'disetujui' : 'ditolak';
        $feedback->update(['status' => $status]);

        return response()->json([
            'success' => true,
            'message' => 'Feedback berhasil ' . $status,
            'data' => $feedback,
        ]);
    }

    /**
     * Delete feedback (Admin)
     */
    public function hapusFeedback($id)
    {
        $feedback = Feedback::find($id);

        if (!$feedback) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Feedback tidak ditemukan',
                ],
                404,
            );
        }

        $feedback->delete();

        return response()->json([
            'success' => true,
            'message' => 'Feedback berhasil dihapus',
        ]);
    }
}
