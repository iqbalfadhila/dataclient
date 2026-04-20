@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Detail Client</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-light">
            <h5 class="mb-0">{{ $client->nama_client }}</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>ID PKF:</strong>
                </div>
                <div class="col-md-8">
                    <span class="badge bg-primary">{{ $client->id_pkf }}</span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Nama Client:</strong>
                </div>
                <div class="col-md-8">
                    {{ $client->nama_client }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Alamat:</strong>
                </div>
                <div class="col-md-8">
                    {{ $client->alamat }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Email:</strong>
                </div>
                <div class="col-md-8">
                    <a href="mailto:{{ $client->email }}">{{ $client->email }}</a>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Nama PIC:</strong>
                </div>
                <div class="col-md-8">
                    {{ $client->nama_pic }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Nomor HP:</strong>
                </div>
                <div class="col-md-8">
                    <a href="https://wa.me/62{{ substr($client->nomor_hp, 1) }}" target="_blank">
                        {{ $client->nomor_hp }}
                    </a>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Dibuat pada:</strong>
                </div>
                <div class="col-md-8">
                    {{ $client->created_at->format('d M Y H:i') }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Diperbarui pada:</strong>
                </div>
                <div class="col-md-8">
                    {{ $client->updated_at->format('d M Y H:i') }}
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('clients.destroy', $client) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </form>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
