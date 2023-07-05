@extends('layouts.app')

@section('title', 'Daftar Projek')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">@yield('title')</h1>

        <!-- Navtabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ !request()->has('perusahaan') ? 'active' : '' }}" href="{{ route('projek.index') }}">Semua</a>
            </li>
            @foreach($perusahaan as $item)
                <li class="nav-item">
                    <a class="nav-link {{ request()->perusahaan == $item->id ? 'active' : '' }}" href="{{ route('projek.index', ['perusahaan' => $item->id]) }}">{{ $item->nama }}</a>
                </li>
            @endforeach
        </ul>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('projek.create') }}" class="m-0 font-weight-bold btn btn-primary">Tambah Data</a>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('projek.index') }}" method="GET" class="form-inline float-right">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="Cari..." value="{{ $keyword }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID Projek</th>
                                <th>Nama Projek</th>
                                <th>Instansi</th>
                                <th>Perusahaan</th>
                                <th>Nilai Pagu/HVS</th>
                                <th>Tahapan</th>
                                <th>SPK/PO/KONTRAK</th>
                                <th>Budget Limit</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projek as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->id_projek }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ optional($item->instansi)->name }}</td>
                                    <td>{{ optional($item->perusahaan)->nama }}</td>
                                    <td>RP. {{ number_format(floatval($item->nilai_pagu), 0, ',', '.') }}</td>
                                    <td>{{ optional($item->tahapan)->nama }}</td>
                                    <td>{{ $item->nilai_spk }}</td>
                                    <td>RP. {{ number_format(floatval($item->budget_limit), 0, ',', '.') }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        <a href="{{ route('projek.edit', $item) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('projek.destroy', $item) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {!! $projek->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@push('scripts')
    <!-- DataTables -->
    <script src="{{ asset('/sbadmin2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
