<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalMobil = Mobil::count();
        $mobilTersedia = Mobil::where('status', 'tersedia')->count();
        $totalPelanggan = User::where('role', 'pelanggan')->count();
        $rentalAktif = Rental::where('status', 'disetujui')->count();
        $rentalPending = Rental::where('status', 'pending')->count();

        $recentRentals = Rental::with(['user', 'mobil'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalMobil',
            'mobilTersedia',
            'totalPelanggan',
            'rentalAktif',
            'rentalPending',
            'recentRentals'
        ));
    }
}