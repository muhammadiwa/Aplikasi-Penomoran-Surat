@extends('layouts.app')

@section('title', 'Edit Surat')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">@yield('title')</h1>

        <!-- Form -->
        <form action="{{ route('surat.update', $surat->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group">
                        <label for="keterangan_projek">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" value="{{ $surat->keterangan_projek }}" name="keterangan_projek" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('surat.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </form>
    </div>
@endsection
