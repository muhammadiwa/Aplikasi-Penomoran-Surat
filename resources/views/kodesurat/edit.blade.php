@extends('layouts.app')

@section('title', 'Edit Kode Surat')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">@yield('title')</h1>

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('kodesurat.update', $kodesurat) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $kodesurat->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="kode_surat">Kode Surat</label>
                        <input type="text" class="form-control" id="kode_surat" name="kode_surat" value="{{ $kodesurat->kode_surat }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('kodesurat.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
