@extends('layouts.app')

@section('title', 'Daftar Perusahaan')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">@yield('title')</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('perusahaan.create') }}" class="m-0 font-weight-bold btn btn-primary">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Perusahaan</th>
                                <th>Kode PT</th>
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
                                        <a href="{{ route('perusahaan.show', $item) }}" class="btn btn-info btn-sm">Detail</a>
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
        });
    </script>
@endpush
