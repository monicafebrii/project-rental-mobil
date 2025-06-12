@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Data Rental</h2>

    <form action="{{ route('admin.edit', $rental->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Contoh field: status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="pending" {{ $rental->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="terpakai" {{ $rental->status == 'terpakai' ? 'selected' : '' }}>Terpakai</option>
                <option value="selesai" {{ $rental->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <!-- Tambahkan field lainnya di sini sesuai kebutuhan -->

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('admin.rental.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
