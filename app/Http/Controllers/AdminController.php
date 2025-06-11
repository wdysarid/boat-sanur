<?php

namespace App\Http\Controllers;

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

    public function apiRequest($method, $url, $data = [])
    {
        try {
            $response = Http::withToken(session('token'))
                ->$method($this->apiUrl.$url, $data);

            return $response->json();
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error connecting to API: '.$e->getMessage()
            ];
        }
    }
}
