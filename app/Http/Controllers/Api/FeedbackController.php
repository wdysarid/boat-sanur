<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{

    public function index(Request $request)
    {
        $query = Feedback::query();

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('review', 'like', "%{$search}%");
            });
        }

        // Paginate results (15 per page)
        $feedbacks = $query->orderBy('created_at', 'desc')->paginate(15);

        // Preserve query parameters in pagination links
        $feedbacks->appends($request->query());

        // Calculate statistics
        $totalFeedback = Feedback::count();
        $pendingCount = Feedback::where('status', 'pending')->count();
        $approvedCount = Feedback::where('status', 'approved')->count();
        $rejectedCount = Feedback::where('status', 'rejected')->count();

        $averageRating = Feedback::where('status', 'approved')->avg('rating') ?? 0;

        // Calculate rating distribution
        $ratingDistribution = [];
        for ($i = 1; $i <= 5; $i++) {
            $count = Feedback::where('rating', $i)->count();
            $percentage = $totalFeedback > 0 ? round(($count / $totalFeedback) * 100) : 0;
            $ratingDistribution[$i] = $percentage;
        }

        return view('admin.feedback', compact(
            'feedbacks',
            'totalFeedback',
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'averageRating',
            'ratingDistribution'
        ));
    }

    /**
     * Get approved feedback
     */
    public function getFeedbackDisetujui()
    {
        $feedback = Feedback::with('user')
            ->where('disetujui', true)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $feedback
        ]);
    }

    /**
     * Get all feedback (admin only)
     */
    public function getSemuaFeedback()
    {
        $feedback = Feedback::with('user')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $feedback
        ]);
    }

    /**
     * Add new feedback
     */
    public function tambahFeedback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pesan' => 'required|string|max:500',
            // 'rating' => 'sometimes|integer|between:1,5'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $feedback = Feedback::create([
            'user_id' => $request->user()->id,
            'pesan' => $request->pesan,
            // 'rating' => $request->rating ?? null,
            'disetujui' => false
        ]);

        return response()->json([
            'success' => true,
            'data' => $feedback,
            'message' => 'Feedback berhasil dikirim'
        ], 201);
    }

    /**
     * Get user's feedback
     */
    public function getFeedbackSaya(Request $request)
    {
        $feedback = Feedback::where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $feedback
        ]);
    }

    /**
     * Approve feedback (Admin)
     */
    public function setujuiFeedback($id)
    {
        $feedback = Feedback::find($id);

        if (!$feedback) {
            return response()->json([
                'success' => false,
                'message' => 'Feedback tidak ditemukan'
            ], 404);
        }

        $feedback->update(['disetujui' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Feedback berhasil disetujui'
        ]);
    }

    /**
     * Delete feedback (Admin)
     */
    public function hapusFeedback($id)
    {
        $feedback = Feedback::find($id);

        if (!$feedback) {
            return response()->json([
                'success' => false,
                'message' => 'Feedback tidak ditemukan'
            ], 404);
        }

        $feedback->delete();

        return response()->json([
            'success' => true,
            'message' => 'Feedback berhasil dihapus'
        ]);
    }


}
