@extends('layouts.app')

@section('title', 'Edit Perusahaan')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">@yield('title')</h1>

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('karyawan.update', $karyawan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama karyawan</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $karyawan->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $karyawan->email }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
