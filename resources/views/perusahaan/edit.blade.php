@extends('layouts.app')

@section('title', 'Edit Perusahaan')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">@yield('title')</h1>

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('perusahaan.update', $perusahaan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $perusahaan->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="kode_pt">Kode PT</label>
                        <input type="text" class="form-control" id="kode_pt" name="kode_pt" value="{{ $perusahaan->kode_pt }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
