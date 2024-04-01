@extends('layouts.app')

@section('title', 'Daftar Surat')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">@yield('title')</h1>

        <!-- Navtabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ !request()->has('perusahaan') ? 'active' : '' }}" href="{{ route('surat.index') }}">Semua</a>
            </li>
            @foreach($perusahaan as $item)
                <li class="nav-item">
                    <a class="nav-link {{ request()->perusahaan == $item->id ? 'active' : '' }}" href="{{ route('surat.index', ['perusahaan' => $item->id]) }}">{{ $item->nama }}</a>
                </li>
            @endforeach
        </ul>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('surat.create') }}" class="m-0 font-weight-bold btn btn-primary">Tambah Data</a>
                    </div>
                    {{-- <div class="col-md-6">
                        <form action="{{ route('surat.index') }}" method="GET" class="form-inline float-right">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="Cari..." value="{{ $keyword }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div> --}}
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
                                <th data-sortable="true">No.</th>
                                <th data-sortable="true">Nomor Surat</th>
                                <th data-sortable="true">Keterangan</th>
                                <th data-sortable="true">Pembuat</th>
                                <th data-sortable="true">Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($surat as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{ $item->keterangan_projek }}</td>
                                    <td>{{ $item->createdBy->name }}</td>
                                    <td>{{ $item->created_at->format('d M Y (H:i:s)') }}</td>
                                    <td>
                                        <a href="{{ route('surat.edit', $item) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('surat.destroy', $item) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</<button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    {{-- {!! $surat->withQueryString()->links('pagination::bootstrap-5') !!} --}}
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <!-- Page level custom scripts -->
    
@endsection


