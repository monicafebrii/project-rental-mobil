<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    /**
     * Tampilkan daftar mobil tersedia.
     */
    public function index()
    {
        $mobil = Mobil::where('status', 'tersedia')->paginate(6);
        return view('rental.index', compact('mobil'));
    }

    /**
     * Tampilkan detail satu mobil.
     */
    public function show(Mobil $mobil)
    {
        return view('rental.show', compact('mobil'));
    }

    /**
     * Formulir pengajuan rental.
     */
    public function create(Mobil $mobil)
    {
        // Cek apakah mobil tersedia
        if ($mobil->status !== 'tersedia') {
            return redirect()->route('rental.index')->with('error', 'Mobil tidak tersedia untuk disewa.');
        }

        return view('rental.create', compact('mobil'));
    }

    /**
     * Simpan pengajuan rental.
     */
    public function store(Request $request, Mobil $mobil)
    {
        // Validasi input
        $request->validate([
            'tanggal_mulai'   => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'catatan'         => 'nullable|string|max:255',
        ]);

        // Hitung durasi rental
        $start = new \DateTime($request->tanggal_mulai);
        $end = new \DateTime($request->tanggal_selesai);
        $selisih = $start->diff($end)->days + 1;

        $total_harga = $mobil->harga_per_hari * $selisih;

        // Simpan data rental
        Rental::create([
            'user_id'         => Auth::id(),
            'mobil_id'        => $mobil->id,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'lama_hari'       => $selisih,
            'catatan'         => $request->catatan,
            'total_harga'     => $total_harga,
            'status'          => 'pending',
        ]);

        return redirect()->route('rental.index')->with('success', 'Pengajuan rental berhasil dikirim. Menunggu konfirmasi admin.');
    }
    // app/Http/Controllers/RentalController.php


    public function myRentals()
    {
        $rentals = Rental::with('mobil')->where('user_id', Auth::id())->latest()->paginate(10);
        return view('rental.my-rentals', compact('rentals'));
    }
}


