<?php

namespace App\Http\Controllers;

use App\Models\Projek;
use App\Models\Instansi;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class ProjekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projek = Projek::with(['instansi', 'perusahaan'])->get();
        return view('projek.index', compact('projek'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instansi = Instansi::all();
        $perusahaan = Perusahaan::all();
        return view('projek.create', compact('instansi', 'perusahaan'));
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
            'id_instansi' => 'required',
            'id_perusahaan' => 'required',
            'keterangan' => 'required',
        ]);

        // Mendapatkan urutan terakhir proyek dari database
        $lastProjek = Projek::where('id_perusahaan', $validatedData['id_perusahaan'])
            ->orderBy('id', 'desc')
            ->first();
        $lastOrder = $lastProjek ? intval(substr($lastProjek->id, 0, 2)) : 0;

        // Menambahkan 1 pada urutan terakhir untuk mendapatkan urutan proyek baru
        $newOrder = $lastOrder + 1;
        $formattedOrder = sprintf('%02d', $newOrder);

        // Mendapatkan dua digit terakhir dari tahun saat ini
        $currentYear = date('y');

        // Membentuk ID proyek berdasarkan id_perusahaan
        $idPerusahaan = $validatedData['id_perusahaan'];

        switch ($idPerusahaan) {
            case 1:
                $projectId = $formattedOrder . '/AMI/000';
                break;
            case 2:
                $projectId = '00/EPSI/' . $currentYear;
                break;
            case 3:
                $projectId = 'DPJ/00/' . $currentYear;
                break;
            default:
                $projectId = '';
        }

        $validatedData['id'] = $projectId;

        Projek::create($validatedData);

        return redirect()->route('projek.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projek  $projek
     * @return \Illuminate\Http\Response
     */
    public function show(Projek $projek)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Projek  $projek
     * @return \Illuminate\Http\Response
     */
    public function edit(Projek $projek)
    {
        return view('projek.edit', compact('projek'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Projek  $projek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Projek $projek)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'id_instansi' => 'required',
            'id_perusahaan' => 'required',
            'keterangan' => 'required',
        ]);

        $projek->update($validatedData);

        return redirect()->route('projek.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projek  $projek
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projek $projek)
    {
        $projek->delete();

        return redirect()->route('projek.index')->with('success', 'Data berhasil dihapus.');
    }
}
