@extends('layouts.app')

@section('title', 'Daftar Perusahaan')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">@yield('title')</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('perusahaan.create') }}" class="m-0 font-weight-bold btn btn-primary">Tambah Data</a>
                    </div>
                    {{-- <div class="col-md-6">
                        <form action="{{ route('perusahaan.index') }}" method="GET" class="form-inline float-right">
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
                                <th data-sortable="true">Nama Perusahaan</th>
                                <th data-sortable="true">Kode PT</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Loop through the $perusahaan data --}}
                            @foreach($perusahaan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kode_pt }}</td>
                                    <td>
                                        <a href="{{ route('perusahaan.edit', $item) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('perusahaan.destroy', $item) }}" method="POST" style="display: inline-block;">
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
            {{-- {!! $perusahaan->withQueryString()->links('pagination::bootstrap-5') !!} --}}
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/sbadmin2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({
                "lengthMenu": [10, 25, 50, 100],
                "language": {
                    "lengthMenu": "Show _MENU_ entries",
                    "search": "Search:",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "paginate": {
                        "previous": "Previous",
                        "next": "Next"
                    }
                }
            });
            $('input[name="keyword"]').keyup(function () {
                table.search($(this).val()).draw();
            });
        });
    </script>
@endpush
