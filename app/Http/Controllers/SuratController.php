<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
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
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $perusahaan = Perusahaan::all();
        $surat = Surat::when($request->perusahaan, function ($query, $perusahaan) {
            return $query->where('id_perusahaan', $perusahaan);
        })
        ->when($keyword, function ($query) use ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('keterangan', 'like', '%' . $keyword . '%')
                    ->orWhere('keterangan_projek', 'like', '%' . $keyword . '%')
                    ->orWhereHas('createdBy', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    });
            });
        })->get();

        return view('surat.index', compact('perusahaan', 'surat', 'keyword'));
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
        $perusahaans = Perusahaan::all();
        $instansi = Instansi::all();
        return view('surat.create', compact('kodesurat','projek', 'perusahaans', 'instansi'));
    }

    public function getProjectsByPerusahaan($id_perusahaan)
    {
        $projeks = Projek::where('id_perusahaan', $id_perusahaan)->get();
        return response()->json($projeks);
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
            'bulan' => 'required',
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
        $bulan = Carbon::createFromFormat('Y-m', $validatedData['bulan'])->format('F');
        $bulanRomawi = $this->convertToRoman($bulan);
        $tahun = Carbon::createFromFormat('Y-m', $validatedData['bulan'])->format('Y');

        if ($projek->id_perusahaan == 1) {
            $keterangan = "{$projek->no_projek}/{$noUrut}/{$perusahaan->kode_pt}/{$kodesurat->kode_surat}/{$instansi->kode_instansi}/{$bulanRomawi}/{$tahun}";
        } elseif ($projek->id_perusahaan == 2) {
            $keterangan = "{$projek->no_projek}/{$noUrut}/{$perusahaan->kode_pt}/{$kodesurat->kode_surat}-{$instansi->kode_instansi}/{$bulanRomawi}/{$tahun}";
        } elseif ($projek->id_perusahaan == 3) {
            $keterangan = "{$kodesurat->kode_surat}/{$projek->no_projek}.{$noUrut}/{$perusahaan->kode_pt}-{$instansi->kode_instansi}/{$bulanRomawi}/{$tahun}";
        }

        $validatedData['id_instansi'] = $projek->id_instansi;
        $validatedData['id_perusahaan'] = $projek->id_perusahaan;
        $validatedData['no_urut'] = $noUrut;
        $validatedData['keterangan'] = $keterangan;
        $user = auth()->user();
        $validatedData['user_id'] = $user->id;
        $validatedData['bulan'] = $bulanRomawi;


        Surat::create($validatedData);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil dibuat.');
    }

    private function convertToRoman($month)
    {
        $romawi = [
            'January' => 'I',
            'February' => 'II',
            'March' => 'III',
            'April' => 'IV',
            'May' => 'V',
            'June' => 'VI',
            'July' => 'VII',
            'August' => 'VIII',
            'September' => 'IX',
            'October' => 'X',
            'November' => 'XI',
            'December' => 'XII',
        ];

        return $romawi[$month];
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
            'keterangan_projek' => 'required',
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
