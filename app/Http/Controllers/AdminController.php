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

}

// tambah else error
