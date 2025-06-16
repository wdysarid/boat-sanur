<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the about us page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Data untuk halaman About Us
        $aboutData = [
            'company_name' => 'Sanur Boat Pass',
            'founded_year' => '2016',
            'experience_years' => '7.5',
            'destinations_count' => 42,
            'happy_travelers' => '15K+',
            'satisfaction_rate' => '98%',
            'mission' => 'To provide safe, comfortable, and memorable sea journeys connecting travelers with the most beautiful islands around Bali.',
            'vision' => 'To become the leading boat service provider in Indonesia, known for exceptional service and unforgettable travel experiences.'
        ];

        return view('about', compact('aboutData'));
    }
}
