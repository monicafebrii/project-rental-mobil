<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = 'mobil';

    protected $fillable = [
        'nama_mobil',
        'merk',
        'tahun',
        'plat_nomor',
        'harga_per_hari',
        'status',
        'deskripsi',
        'foto',
    ];

    public function rental()
    {
        return $this->hasMany(Rental::class);
    }

    public function isTersedia()
    {
        return $this->status === 'tersedia';
    }

    public function scopeTersedia($query)
    {
        return $query->where('status', 'tersedia');
    }
}
