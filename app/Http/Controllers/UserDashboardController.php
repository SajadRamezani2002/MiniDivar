<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Ad;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $ads = Ad::where('user_id', $user->id)->latest()->get();

        $stats = [
            'total' => $ads->count(),
            'pending' => $ads->where('status', 'pending')->count(),
            'active' => $ads->where('status', 'active')->count(),
            'rejected' => $ads->where('status', 'rejected')->count(),
        ];

        return view('dashboard.user', compact('user', 'ads', 'stats'));
    }
}
