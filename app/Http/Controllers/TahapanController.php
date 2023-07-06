<?php

namespace App\Http\Controllers;

use App\Models\Tahapan;
use Illuminate\Http\Request;

class TahapanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $tahapan = Tahapan::when($keyword, function ($query) use ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%');
        })->get();
        return view('tahapan.index', compact('tahapan', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tahapan.create');
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
        ]);

        Tahapan::create($validatedData);

        return redirect()->route('tahapan.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tahapan  $tahapan
     * @return \Illuminate\Http\Response
     */
    public function show(Tahapan $tahapan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tahapan  $tahapan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tahapan $tahapan)
    {
        return view('tahapan.edit', compact('tahapan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tahapan  $tahapan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tahapan $tahapan)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        $tahapan->update($validatedData);

        return redirect()->route('tahapan.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tahapan  $tahapan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tahapan $tahapan)
    {
        $tahapan->delete();

        return redirect()->route('tahapan.index')->with('success', 'Data berhasil dihapus.');
    }
}
