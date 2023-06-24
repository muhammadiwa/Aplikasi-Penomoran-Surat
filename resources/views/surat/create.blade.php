@extends('layouts.app')

@section('title', 'Tambah Surat')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">@yield('title')</h1>

        <!-- Form -->
        <form action="{{ route('surat.store') }}" method="POST">
            @csrf
            <div class="card shadow mb-4">
                <div class="card-body">
                    {{-- <div class="form-group">
                        <label for="nama">Nama surat</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div> --}}
                    <div class="form-group">
                        <label for="kode_surat">Kode Surat</label>
                        <select class="form-control" id="kode_surat" name="kode_surat" required>
                            @foreach ($kodesurat as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_projek">ID Projek</label>
                        <select class="form-control" id="id_projek" name="id_projek" required>
                            @foreach ($projek as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_instansi">Instansi</label>
                        <select class="form-control" id="id_instansi" name="id_instansi" required>
                            @foreach ($instansi as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_perusahaan">Perusahaan</label>
                        <select class="form-control" id="id_perusahaan" name="id_perusahaan" required>
                            @foreach ($perusahaan as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keterangan_projek">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" value="-" name="keterangan_projek" required>
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
