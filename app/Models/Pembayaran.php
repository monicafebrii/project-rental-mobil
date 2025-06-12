<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
     use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'rental_id',
        'jumlah',
        'metode_pembayaran',
        'status',
        'tanggal_pembayaran',
        'keterangan',
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'tanggal_pembayaran' => 'date',
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function isLunas()
    {
        return $this->status === 'lunas';
    }
}