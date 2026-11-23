<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalEvents'    => Event::count(),
            'upcomingEvents' => Event::upcoming()->count(),
            'totalUsers'     => User::where('role', '!=', 'admin')->count(),
        ]);
    }
}