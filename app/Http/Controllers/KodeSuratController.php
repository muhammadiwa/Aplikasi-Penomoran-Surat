<?php

namespace App\Http\Controllers;

use App\Models\KodeSurat;
use Illuminate\Http\Request;

class KodeSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $kodesurat = KodeSurat::when($keyword, function ($query) use ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%')
                ->orWhere('kode_surat', 'like', '%' . $keyword . '%');
        })->get();
        return view('kodesurat.index', compact('kodesurat', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kodesurat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'kode_surat' => 'required',
        ]);

        KodeSurat::create($validatedData);

        return redirect()->route('kodesurat.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KodeSurat  $kodesurat
     * @return \Illuminate\Http\Response
     */
    public function show(KodeSurat $kodesurat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KodeSurat  $kodesurat
     * @return \Illuminate\Http\Response
     */
    public function edit(KodeSurat $kodesurat)
    {
        return view('kodesurat.edit', compact('kodesurat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KodeSurat  $kodesurat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KodeSurat $kodesurat)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'kode_surat' => 'required',
        ]);

        $kodesurat->update($validatedData);

        return redirect()->route('kodesurat.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KodeSurat  $kodesurat
     * @return \Illuminate\Http\Response
     */
    public function destroy(KodeSurat $kodesurat)
    {
        $kodesurat->delete();

        return redirect()->route('kodesurat.index')->with('success', 'Data berhasil dihapus.');
    }
}
