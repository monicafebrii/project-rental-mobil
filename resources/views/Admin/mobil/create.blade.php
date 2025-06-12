@extends('layouts.app')

@section('content')

   <div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-lg border-0" style="border-radius: 20px; overflow: hidden;">
            <div class="card-header text-white position-relative" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 50%, #ff9ff3 100%); padding: 2rem;">
                <div class="position-absolute"
                    style="top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1;
                           background: url('data:image/svg+xml,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 100 100&quot;><circle cx=&quot;20&quot; cy=&quot;20&quot; r=&quot;2&quot; fill=&quot;white&quot;/><circle cx=&quot;80&quot; cy=&quot;80&quot; r=&quot;3&quot; fill=&quot;white&quot;/><circle cx=&quot;40&quot; cy=&quot;70&quot; r=&quot;1&quot; fill=&quot;white&quot;/><circle cx=&quot;70&quot; cy=&quot;30&quot; r=&quot;2&quot; fill=&quot;white&quot;/><circle cx=&quot;10&quot; cy=&quot;50&quot; r=&quot;1.5&quot; fill=&quot;white&quot;/></svg>');">
                </div>
                <h4 class="mb-0 position-relative" style="font-weight: 600;">
                    <i class="fas fa-car me-2" style="color: #fff; text-shadow: 0 2px 4px rgba(0,0,0,0.3);"></i>
                    Tambah Mobil Baru
                </h4>
            </div>

                
                <div class="card-body p-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                    <style>
                        .form-control, .form-select {
                            border-radius: 12px;
                            border: 2px solid #e9ecef;
                            padding: 0.75rem 1rem;
                            transition: all 0.3s ease;
                        }
                        .form-control:focus, .form-select:focus {
                            border-color: #ff6b6b;
                            box-shadow: 0 0 0 0.25rem rgba(255, 107, 107, 0.25);
                            transform: translateY(-2px);
                        }
                        .form-label {
                            color: #495057;
                            margin-bottom: 0.5rem;
                            font-weight: 600;
                        }
                        .form-label i {
                            color: #ff6b6b;
                        }
                        .input-group-text {
                            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
                            border: none;
                            color: white;
                            font-weight: 600;
                            border-radius: 12px 0 0 12px;
                        }
                        .btn {
                            border-radius: 12px;
                            padding: 0.75rem 1.5rem;
                            font-weight: 600;
                            transition: all 0.3s ease;
                        }
                        .btn:hover {
                            transform: translateY(-2px);
                            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                        }
                        .btn-success {
                            background: linear-gradient(135deg, #00d2ff, #3a7bd5);
                            border: none;
                        }
                        .btn-outline-secondary {
                            border: 2px solid #6c757d;
                            color: #6c757d;
                        }
                        .btn-outline-secondary:hover {
                            background: #6c757d;
                            border-color: #6c757d;
                        }
                    </style>
                    <form action="{{ route('admin.mobil.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-tag me-1"></i>Nama Mobil
                                </label>
                                <input type="text" name="nama_mobil" 
                                       class="form-control @error('nama_mobil') is-invalid @enderror" 
                                       value="{{ old('nama_mobil') }}" 
                                       placeholder="✨ Masukkan nama mobil">
                                @error('nama_mobil') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-industry me-1"></i>Merk
                                </label>
                                <input type="text" name="merk" 
                                       class="form-control @error('merk') is-invalid @enderror" 
                                       value="{{ old('merk') }}" 
                                       placeholder="🚗 Toyota, Honda, dll">
                                @error('merk') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-calendar me-1"></i>Tahun
                                </label>
                                <input type="text" name="tahun" 
                                       class="form-control @error('tahun') is-invalid @enderror" 
                                       value="{{ old('tahun') }}" 
                                       placeholder="📅 2020">
                                @error('tahun') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-id-card me-1"></i>Plat Nomor
                                </label>
                                <input type="text" name="plat_nomor" 
                                       class="form-control @error('plat_nomor') is-invalid @enderror" 
                                       value="{{ old('plat_nomor') }}" 
                                       placeholder="🔢 B 1234 XYZ">
                                @error('plat_nomor') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-money-bill me-1"></i>Harga per Hari
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga_per_hari" 
                                           class="form-control @error('harga_per_hari') is-invalid @enderror" 
                                           value="{{ old('harga_per_hari') }}" 
                                           placeholder="500000"
                                           style="border-radius: 0 12px 12px 0;">
                                </div>
                                @error('harga_per_hari') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-info-circle me-1"></i>Status
                                </label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>
                                        Tersedia
                                    </option>
                                    <option value="disewa" {{ old('status') == 'disewa' ? 'selected' : '' }}>
                                         Disewa
                                    </option>
                                    <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>
                                        🔧 Maintenance
                                    </option>
                                </select>
                                @error('status') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-align-left me-1"></i>Deskripsi
                            </label>
                            <textarea name="deskripsi" 
                                      class="form-control @error('deskripsi') is-invalid @enderror" 
                                      rows="4" 
                                      placeholder="📝 Deskripsi lengkap tentang mobil ini...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-image me-1"></i>Foto Mobil
                            </label>
                            <input type="file" name="foto" 
                                   class="form-control @error('foto') is-invalid @enderror"
                                   accept="image/*">
                            <div class="form-text" style="color: #6c757d; font-style: italic;">
                                📸 Format: JPG, PNG, GIF. Maksimal 2MB
                            </div>
                            @error('foto') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>
                        
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.mobil.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i>Simpan Mobil
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection