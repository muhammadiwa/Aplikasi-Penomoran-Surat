<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $karyawan = User::when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%');
        })->paginate(10);

        return view('karyawan.index', compact('karyawan', 'keyword'));
    }

    public function create()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
        ], [
            'password.min' => 'Gagal! 
            Password harus memiliki setidaknya 6 karakter.',
        ]);

        $validatedData['password'] = bcrypt($request->password);
        User::create($validatedData);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function show(User $karyawan)
    {
        $karyawan = auth()->user();
        return view('karyawan.show', compact('karyawan'));
    }

    public function edit(User $karyawan)
    {
        return view('karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, User $karyawan)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $karyawan->update($validatedData);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diperbarui.');
    }

    public function destroy(User $karyawan)
    {
        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}
