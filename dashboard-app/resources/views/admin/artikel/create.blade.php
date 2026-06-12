@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="card-title mb-0 fw-bold text-secondary">Tambah Artikel Baru</h5>
                </div>
                <div class="card-body p-4">
                    
                    <form method="POST" action="{{ route('admin.artikel.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="judul" class="form-label fw-semibold text-muted">Judul Artikel</label>
                            <input type="text" 
                                   class="form-control @error('judul') is-invalid @enderror" 
                                   id="judul" 
                                   name="judul" 
                                   value="{{ old('judul') }}" 
                                   placeholder="Masukkan judul artikel" 
                                   required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="link" class="form-label fw-semibold text-muted">Link Artikel</label>
                            <input type="url" 
                                   class="form-control @error('link') is-invalid @enderror" 
                                   id="link" 
                                   name="link" 
                                   value="{{ old('link') }}" 
                                   placeholder="https://example.com/artikel" 
                                   required>
                            @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-plus me-1"></i> Simpan Artikel
                            </button>
                            <a href="{{ route('admin.artikel.index') }}" class="btn btn-light px-4 border">
                                Batal
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection