<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Projek;
use App\Models\Instansi;
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
        $surat = Surat::with(['kode_surat','projek','instansi', 'perusahaan'])->get();
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
        $instansi = Instansi::all();
        $perusahaan = Perusahaan::all();
        return view('surat.create', compact('kodesurat','projek','instansi', 'perusahaan'));
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
        'id_instansi' => 'required',
        'id_perusahaan' => 'required',
        'keterangan_projek' => 'required',
    ]);

    // Mendapatkan id_perusahaan
    $idPerusahaan = $validatedData['id_perusahaan'];

    // Mendapatkan urutan terakhir surat dari database berdasarkan id_perusahaan
    $lastSurat = Surat::where('id_perusahaan', $idPerusahaan)
        ->orderBy('id', 'desc')
        ->first();

    // Mendapatkan urutan terakhir dan menentukan nomor urut berikutnya
    $lastUrutan = $lastSurat ? intval(substr($lastSurat->no_urut, -3)) : 0;
    $newUrutan = $lastUrutan + 1;

    // Mendapatkan bulan sekarang dalam format romawi
    $currentMonth = date('m');
    $bulanRomawi = $this->convertToRoman($currentMonth);

    // Mendapatkan tahun sekarang dalam format empat digit
    $currentYear = date('Y');

    // Membentuk keterangan surat berdasarkan id_perusahaan
    $keterangan = '';

    $projek = Projek::find($validatedData['id_projek']);
    $perusahaan = Perusahaan::find($idPerusahaan);
    $kodesurat = KodeSurat::find($validatedData['kode_surat']);
    $instansi = Instansi::find($validatedData['id_instansi']);

    if ($idPerusahaan == 1) {
        $noUrut = sprintf('%03d', $newUrutan);
        $keterangan = "{$projek->no_projek}/{$noUrut}/{$perusahaan->kode_pt}/{$kodesurat->kode_surat}/{$instansi->name}/{$bulanRomawi}/{$currentYear}";
    } elseif ($idPerusahaan == 2) {
        $noUrut = sprintf('%03d', $newUrutan);
        $keterangan = "{$projek->no_projek}/{$noUrut}/{$perusahaan->kode_pt}/{$kodesurat->kode_surat}-{$instansi->name}/{$bulanRomawi}/{$currentYear}";
    } elseif ($idPerusahaan == 3) {
        $noUrut = sprintf('%03d', $newUrutan);
        $keterangan = "{$kodesurat->kode_surat}/{$projek->no_projek}.{$noUrut}/{$perusahaan->kode_pt}-{$instansi->name}/{$bulanRomawi}/{$currentYear}";
    }

    $validatedData['no_urut'] = $noUrut;
    $validatedData['keterangan'] = $keterangan;

    Surat::create($validatedData);

    return redirect()->route('surat.index')->with('success', 'Surat berhasil dibuat.');
}


    private function convertToRoman($number)
    {
        $map = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
            // Tambahkan romawi sesuai kebutuhan
        ];

        return $map[$number] ?? '';
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
        return view('surat.edit', compact('surat'));
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
