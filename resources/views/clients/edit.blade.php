@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Edit Client</h1>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Error!</h4>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('clients.update', $client) }}" method="POST" class="needs-validation">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="id_pkf" class="form-label">ID PKF</label>
                    <input type="text" class="form-control" id="id_pkf"
                           value="{{ $client->id_pkf }}" disabled>
                    <small class="text-muted">ID PKF tidak dapat diubah</small>
                </div>

                <div class="mb-3">
                    <label for="nama_client" class="form-label">Nama Client <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_client') is-invalid @enderror"
                           id="nama_client" name="nama_client" value="{{ old('nama_client', $client->nama_client) }}"
                           placeholder="Masukkan nama client" required>
                    @error('nama_client')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror"
                              id="alamat" name="alamat" rows="3"
                              placeholder="Masukkan alamat client" required>{{ old('alamat', $client->alamat) }}</textarea>
                    @error('alamat')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email" value="{{ old('email', $client->email) }}"
                           placeholder="Masukkan email" required>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_pic" class="form-label">Nama PIC <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_pic') is-invalid @enderror"
                           id="nama_pic" name="nama_pic" value="{{ old('nama_pic', $client->nama_pic) }}"
                           placeholder="Masukkan nama PIC" required>
                    @error('nama_pic')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nomor_hp" class="form-label">Nomor HP <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nomor_hp') is-invalid @enderror"
                           id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp', $client->nomor_hp) }}"
                           placeholder="Contoh: 08123456789" pattern="^08[0-9]{8,10}$" required>
                    <small class="text-muted">Format: 08 diikuti 8-10 digit angka</small>
                    @error('nomor_hp')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
