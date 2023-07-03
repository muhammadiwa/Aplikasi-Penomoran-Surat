<?php

namespace App\Http\Controllers;

use App\Models\Bulan;
use App\Models\Surat;
use App\Models\Tahun;
use App\Models\Projek;
use App\Models\KodeSurat;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surat = Surat::with(['kode_surat','projek'])->get();
        return view('surat.index', compact('surat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kodesurat = KodeSurat::all();
        $projek = Projek::all();
        $perusahaan = Perusahaan::all();
        $bulan = Bulan::all();
        $tahun = Tahun::all();
        return view('surat.create', compact('kodesurat','projek', 'perusahaan', 'bulan', 'tahun'));
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
            'kode_surat' => 'required',
            'id_projek' => 'required',
            'id_bulan' => 'required',
            'id_tahun' => 'required',
            'keterangan_projek' => 'required',
        ]);

        // Mendapatkan id_projek
        $idProjek = $request->input('id_projek');

        // Mendapatkan projek berdasarkan id_projek
        $projek = Projek::find($idProjek);

        // Mendapatkan urutan terakhir surat dari database berdasarkan id_perusahaan
        $lastSurat = Surat::where('id_perusahaan', $projek->id_perusahaan)
            ->orderBy('id', 'desc')
            ->first();

        // Mendapatkan urutan terakhir dan menentukan nomor urut berikutnya
        $lastUrutan = $lastSurat ? intval(substr($lastSurat->no_urut, -3)) : 0;
        $newUrutan = $lastUrutan + 1;
        $noUrut = sprintf('%03d', $newUrutan);

        // Membentuk keterangan surat berdasarkan id_projek dan id_perusahaan
        $perusahaan = $projek->perusahaan;
        $instansi = $projek->instansi;
        $kodesurat = KodeSurat::find($validatedData['kode_surat']);
        $bulan = Bulan::find($validatedData['id_bulan']);
        $tahun = Tahun::find($validatedData['id_tahun']);

        if ($projek->id_perusahaan == 1) {
            $keterangan = "{$projek->no_projek}/{$noUrut}/{$perusahaan->kode_pt}/{$kodesurat->kode_surat}/{$instansi->kode_instansi}/{$bulan->kode_bulan}/{$tahun->tahun}";
        } elseif ($projek->id_perusahaan == 2) {
            $keterangan = "{$projek->no_projek}/{$noUrut}/{$perusahaan->kode_pt}/{$kodesurat->kode_surat}-{$instansi->kode_instansi}/{$bulan->kode_bulan}/{$tahun->tahun}";
        } elseif ($projek->id_perusahaan == 3) {
            $keterangan = "{$kodesurat->kode_surat}/{$projek->no_projek}.{$noUrut}/{$perusahaan->kode_pt}-{$instansi->kode_instansi}/{$bulan->kode_bulan}/{$tahun->tahun}";
        }

        $validatedData['id_perusahaan'] = $projek->id_perusahaan;
        $validatedData['no_urut'] = $noUrut;
        $validatedData['keterangan'] = $keterangan;

        Surat::create($validatedData);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil dibuat.');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function show(Surat $surat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function edit(Surat $surat)
    {
        $kodesurat = KodeSurat::all();
        $projek = Projek::all();
        $perusahaan = Perusahaan::all();
        $bulan = Bulan::all();
        $tahun = Tahun::all();
        return view('surat.edit', compact('surat', 'kodesurat', 'projek', 'perusahaan', 'bulan', 'tahun'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Surat $surat)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $surat->update($validatedData);

        return redirect()->route('surat.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Surat $surat)
    {
        $surat->delete();

        return redirect()->route('surat.index')->with('success', 'Data berhasil dihapus.');
    }
}
