<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class HomeController extends Controller
{
    /**
     * Display the home/landing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get latest approved testimonials for homepage carousel
        $feedbacks = Feedback::with('user')
            ->where('status', 'disetujui')
            ->latest()
            ->limit(10)
            ->get();

        return view('landing', compact('feedbacks'));
    }
}
