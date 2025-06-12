@extends('layouts.app')
                                        <!-- ini form sewa -->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Form Sewa Mobil</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            @if($mobil->foto)
                                <img src="{{ Storage::url($mobil->foto) }}" class="img-fluid rounded" alt="{{ $mobil->nama_mobil }}">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 150px;">
                                    <i class="bi bi-car-front display-4 text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h5>{{ $mobil->nama_mobil }}</h5>
                            <p><strong>Merk:</strong> {{ $mobil->merk }}</p>
                            <p><strong>Tahun:</strong> {{ $mobil->tahun }}</p>
                            <p><strong>Harga per Hari:</strong> <span class="text-primary fw-bold">Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}</span></p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('rental.store', $mobil) }}">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                                           id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" 
                                           min="{{ date('Y-m-d') }}" required>
                                    @error('tanggal_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                    <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                                           id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" 
                                           min="{{ date('Y-m-d') }}" required>
                                    @error('tanggal_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan (Opsional)</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror" 
                                      id="catatan" name="catatan" rows="3" placeholder="Tambahkan catatan jika perlu...">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <strong>Informasi:</strong> Total harga akan dihitung berdasarkan lama hari rental. Konfirmasi dari admin diperlukan sebelum rental disetujui.
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-send"></i> Ajukan Rental
                            </button>
                            <a href="{{ route('rental.show', $mobil) }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tanggalMulai = document.getElementById('tanggal_mulai');
    const tanggalSelesai = document.getElementById('tanggal_selesai');
    
    tanggalMulai.addEventListener('change', function() {
        tanggalSelesai.min = this.value;
        if (tanggalSelesai.value && tanggalSelesai.value < this.value) {
            tanggalSelesai.value = this.value;
        }
    });
});
</script>
@endsection