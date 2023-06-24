@extends('layouts.app')

@section('title', 'Edit Instansi')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">@yield('title')</h1>

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('instansi.update', $instansi) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama Instansi</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $instansi->nama }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('instansi.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
