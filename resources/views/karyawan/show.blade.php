@extends('layouts.app')

@section('title', 'Profil Karyawan')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">@yield('title')</h1>

        <!-- Profile Data -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <h5 class="card-title">Data Karyawan</h5>
                <table class="table table-responsive">
                    <tbody>
                        <tr>
                            <th style="padding-right: 10px;">Nama Karyawan</th>
                            <th style="padding-right: 10px;">:</th>
                            <td>{{ $karyawan->name }}</td>
                        </tr>
                        <tr>
                            <th style="padding-right: 10px;">Email</th>
                            <th style="padding-right: 10px;">:</th>
                            <td>{{ $karyawan->email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Edit Profile Form -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <h5 class="card-title">Edit Profil</h5>
                <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $karyawan->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $karyawan->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{ $karyawan->password }}" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
