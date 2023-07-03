@extends('layouts.app')

@section('title', 'Tambah Projek')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">@yield('title')</h1>

        <!-- Form -->
        <form action="{{ route('projek.store') }}" method="POST">
            @csrf
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama Projek</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
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
                        <label for="nilai_pagu">Nilai Pagu</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">RP.</span>
                            </div>
                            <input type="text" class="form-control" id="nilai_pagu" name="nilai_pagu" value="{{ number_format(old('nilai_pagu', 0), 0, ',', '.') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_tahapan">Tahapan</label>
                        <select class="form-control" id="id_tahapan" name="id_tahapan" required>
                            @foreach ($tahapan as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nilai_spk">SPK/PO/KONTRAK</label>
                        <input type="text" class="form-control" id="nilai_spk" value="-" name="nilai_spk" required>
                    </div>
                    <div class="form-group">
                        <label for="budget_limit">Budget Limit</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">RP.</span>
                            </div>
                            <input type="text" class="form-control" id="budget_limit" value="{{ number_format(old('nilai_pagu', 0), 0, ',', '.') }}" name="budget_limit" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" value="-" name="keterangan" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('projek.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </form>
    </div>
@endsection
