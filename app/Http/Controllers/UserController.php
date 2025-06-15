<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function tambahFeedback(Request $request)
    {
        // Debugging - cek status auth
        logger()->info('Auth check', [
            'auth_check' => auth()->check(),
            'user_id' => auth()->id(),
            'request_user' => $request->user() ? $request->user()->id : null,
        ]);

        // Gunakan web guard secara eksplisit
        if (!auth()->guard('web')->check()) {
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
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        // Gunakan user dari web guard
        $user = auth()->guard('web')->user();

        $feedback = Feedback::create([
            'user_id' => $user->id, // Pastikan pakai user dari guard web
            'pesan' => $request->pesan,
            'rating' => $request->rating,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'data' => $feedback,
            'message' => 'Feedback berhasil dikirim!',
        ]);
    }
}
