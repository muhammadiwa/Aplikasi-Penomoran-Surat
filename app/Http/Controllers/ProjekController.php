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
            'nilai_pagu' => 'required',
            'id_tahapan' => 'required',
            'nilai_spk' => 'required',
            'budget_limit' => 'required',
        ]);

        // Mendapatkan id_perusahaan
        $idPerusahaan = $validatedData['id_perusahaan'];

        // Mendapatkan urutan terakhir proyek dari database berdasarkan id_perusahaan
        $lastProjek = Projek::where('id_perusahaan', $idPerusahaan)
            ->orderBy('id_projek', 'desc')
            ->first();

        // Mendapatkan urutan terakhir dan menentukan nomor urut berikutnya
        $lastOrder = $lastProjek ? intval(substr($lastProjek->id_projek, -3)) : -1;
        $newOrder = $lastOrder + 1;
        // Mendapatkan urutan terakhir dan menentukan nomor urut berikutnya untuk id_perusahaan = 2
        $lastOr = $lastProjek ? intval(substr($lastProjek->id_projek, 4, 2)) : -1;
        $newOr = $lastOr < 0 ? 0 : ($lastOr + 1);
         // Mendapatkan urutan terakhir dan menentukan nomor urut berikutnya untuk id_perusahaan = 2
        $lastOrders = $lastProjek ? intval(substr($lastProjek->id_projek, 0, 2)) : -1;
        $newOrders = $lastOrders + 1;

        // Mendapatkan dua digit terakhir dari tahun saat ini
        $currentYear = date('y');

        // Membentuk ID proyek berdasarkan id_perusahaan
        $projectId = '';
        $noProject = '';

        if ($idPerusahaan == 1) {
            $projectId = $currentYear . '/AMI/' . sprintf('%02d', $newOrder);
            $noProject = sprintf('%02d', $newOrder);
        } elseif ($idPerusahaan == 2) {
            $projectId = 'DPJ/' . sprintf('%02d', $newOr) . '/' . $currentYear;
            $noProject = sprintf('%02d', $newOr);
        } elseif ($idPerusahaan == 3) {
            $projectId = sprintf('%02d', $newOrders) . '/EPSI/' . $currentYear;
            $noProject = sprintf('%02d', $newOrders);
        }

        $validatedData['id_projek'] = $projectId;
        $validatedData['no_projek'] = $noProject;

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
            'nilai_pagu' => 'required',
            'id_tahapan' => 'required',
            'nilai_spk' => 'required',
            'budget_limit' => 'required',
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
