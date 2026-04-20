@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Data Client</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('clients.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Client
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <form action="{{ route('clients.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <select name="filter_field" class="form-select">
                        <option value="">Pilih Field untuk Filter</option>
                        <option value="nama_client" {{ request('filter_field') == 'nama_client' ? 'selected' : '' }}>Nama Client</option>
                        <option value="email" {{ request('filter_field') == 'email' ? 'selected' : '' }}>Email</option>
                        <option value="nama_pic" {{ request('filter_field') == 'nama_pic' ? 'selected' : '' }}>Nama PIC</option>
                        <option value="nomor_hp" {{ request('filter_field') == 'nomor_hp' ? 'selected' : '' }}>Nomor HP</option>
                        <option value="id_pkf" {{ request('filter_field') == 'id_pkf' ? 'selected' : '' }}>ID PKF</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" name="filter_value" class="form-control" placeholder="Masukkan nilai filter..." value="{{ request('filter_value') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Pencarian umum..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
            </form>
            @if(request('filter_field') || request('search'))
                <div class="mt-2">
                    <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-times"></i> Reset Filter
                    </a>
                </div>
            @endif
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($clients->isEmpty())
        @if(request('search') || request('filter_field'))
            <div class="alert alert-warning">
                Tidak ada client yang cocok dengan filter yang diterapkan.
                @if(request('search'))
                    Pencarian: "{{ request('search') }}"
                @endif
                @if(request('filter_field'))
                    | Filter {{ request('filter_field') }}: "{{ request('filter_value') }}"
                @endif
                <br><a href="{{ route('clients.index') }}">Tampilkan semua client</a>
            </div>
        @else
            <div class="alert alert-info">
                Tidak ada data client. <a href="{{ route('clients.create') }}">Tambah client baru</a>
            </div>
        @endif
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID PKF</th>
                        <th>Nama Client</th>
                        <th>Email</th>
                        <th>Nama PIC</th>
                        <th>Nomor HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clients as $client)
                        <tr>
                            <td><strong>{{ $client->id_pkf }}</strong></td>
                            <td>{{ $client->nama_client }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->nama_pic }}</td>
                            <td>{{ $client->nomor_hp }}</td>
                            <td>
                                <a href="{{ route('clients.show', $client) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('clients.destroy', $client) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
