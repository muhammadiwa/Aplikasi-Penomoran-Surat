@extends('layouts.app')

@section('title', 'Daftar Instansi')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">@yield('title')</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('instansi.create') }}" class="m-0 font-weight-bold btn btn-primary">Tambah Data</a>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('instansi.index') }}" method="GET" class="form-inline float-right">
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
                                <th>Nama Instansi</th>
                                <th>Kode Instansi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($instansi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->kode_instansi }}</td>
                                    <td>
                                        <a href="{{ route('instansi.edit', $item) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('instansi.destroy', $item) }}" method="POST" style="display: inline-block;">
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
                {!! $instansi->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
