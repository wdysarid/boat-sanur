<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
   public function index()
{
    $totalUsers = \App\Models\User::count();
    return view('admin.dashboard', compact('totalUsers'));
}
 //
}
