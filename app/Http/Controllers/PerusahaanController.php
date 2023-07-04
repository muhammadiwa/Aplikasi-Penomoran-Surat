<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index()
    {
        $perusahaan = Perusahaan::all();
        return view('perusahaan.index', compact('perusahaan'));
    }

    public function create()
    {
        return view('perusahaan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'kode_pt' => 'required',
        ]);

        Perusahaan::create($validatedData);

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil ditambahkan.');
    }

    public function show(Perusahaan $perusahaan)
    {
        //
    }

    public function edit(Perusahaan $perusahaan)
    {
        return view('perusahaan.edit', compact('perusahaan'));
    }

    public function update(Request $request, Perusahaan $perusahaan)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'kode_pt' => 'required',
        ]);

        $perusahaan->update($validatedData);

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil diperbarui.');
    }

    public function destroy(Perusahaan $perusahaan)
    {
        $perusahaan->delete();

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil dihapus.');
    }
}
