<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $mobil = Mobil::tersedia()->latest()->take(6)->get();
        return view('welcome', compact('mobil'));
    }

    public function dashboard()
    {
        if (Auth::user()->isAdmin()) {
            return redirect('/admin/dashboard');
        }

        $rental = Rental::where('user_id', Auth::id())
            ->with(['mobil'])
            ->latest()
            ->get();

        return view('dashboard', compact('rental'));
    }
}