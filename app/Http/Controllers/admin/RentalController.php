<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with(['mobil', 'user'])->latest()->paginate(10);
        return view('admin.rental.index', compact('rentals'));
    }

    public function show(Rental $rental)
    {
        $rental->load(['user', 'mobil', 'pembayaran']);
        return view('admin.rental.show', compact('rental'));
    }

    public function updateStatus(Request $request, Rental $rental)
    {
        $request->validate([
            'status' => 'required|in:pending,disetujui,selesai,dibatalkan',
        ]);

        $oldStatus = $rental->status;
        $rental->update([
            'status' => $request->status,
        ]);

        // Update status mobil
        if ($request->status === 'disetujui' && $oldStatus === 'pending') {
            $rental->mobil->update(['status' => 'disewa']);
        } elseif (in_array($request->status, ['selesai', 'dibatalkan']) && $oldStatus === 'disetujui') {
            $rental->mobil->update(['status' => 'tersedia']);
        }

        return redirect()->back()
            ->with('success', 'Status rental berhasil diperbarui.');
    }
}
