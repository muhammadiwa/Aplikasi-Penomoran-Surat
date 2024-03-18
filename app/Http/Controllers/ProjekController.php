<?php

namespace App\Http\Controllers;

use App\Models\Projek;
use App\Models\Tahapan;
use App\Models\Instansi;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjekController extends Controller
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
        $projek = Projek::with(['instansi', 'perusahaan', 'tahapan'])
            ->when($request->perusahaan, function ($query, $perusahaan) {
                return $query->where('id_perusahaan', $perusahaan);
            })
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('nama', 'like', '%' . $keyword . '%')
                        ->orWhere('id_projek', 'like', '%' . $keyword . '%')
                        ->orWhereHas('instansi', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                        })
                        ->orWhereHas('perusahaan', function ($query) use ($keyword) {
                            $query->where('nama', 'like', '%' . $keyword . '%');
                        })
                        ->orWhereHas('tahapan', function ($query) use ($keyword) {
                            $query->where('nama', 'like', '%' . $keyword . '%');
                        });
                });
            })
            ->paginate(10);

        return view('projek.index', compact('perusahaan', 'projek', 'keyword'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projek = Projek::all();
        $tahapan = Tahapan::all();
        $instansi = Instansi::all();
        $perusahaan = Perusahaan::all();
        return view('projek.create', compact('projek','instansi', 'perusahaan', 'tahapan'));
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

        // Mendapatkan dua digit terakhir dari tahun saat ini
        $currentYear = date('y');
        // Mendapatkan id_perusahaan
        $idPerusahaan = $validatedData['id_perusahaan'];

        // Mendapatkan urutan terakhir proyek dari database berdasarkan id_perusahaan
        $lastProjek = Projek::where('id_perusahaan', $idPerusahaan)
            ->orderBy('id_projek', 'desc')
            ->first();

        $currentProject = Projek::where('id_perusahaan', $idPerusahaan)
            ->where('id_instansi', 1)
            ->where('id_projek', 'like', '%' . $currentYear . '%')
            ->get();        
        

        // Mendapatkan urutan terakhir dan menentukan nomor urut berikutnya untuk id_perusahaan = 1
        $lastOrder = $lastProjek ? intval(substr($lastProjek->id_projek, -3)) : -1;
        $newOrder = $lastOrder + 1;
        // Mendapatkan urutan terakhir dan menentukan nomor urut berikutnya untuk id_perusahaan = 2
        $lastOr = $lastProjek ? intval(substr($lastProjek->id_projek, 4, 2)) : -1;
        $newOr = $lastOr < 0 ? 0 : ($lastOr + 1);
        // Mendapatkan urutan terakhir dan menentukan nomor urut berikutnya untuk id_perusahaan = 3
        $lastOrders = $lastProjek ? intval(substr($lastProjek->id_projek, 0, 2)) : -1;
        $newOrders = $lastOrders + 1;

        if ($currentProject->isEmpty()) {
            $newOrder = 0;
            $newOr = 0;
            $newOrders = 0;
        }

        // dd($newOrder, $newOr, $newOrders);

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
        $tahapan = Tahapan::all();
        $instansi = Instansi::all();
        $perusahaan = Perusahaan::all();
        return view('projek.edit', compact('projek', 'tahapan', 'instansi', 'perusahaan'));
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

        // Menghapus simbol koma dan titik dari nilai pagu
        $nilaiPagu = str_replace(',', '', $validatedData['nilai_pagu']);
        $nilaiPagu = str_replace('.', '', $nilaiPagu);

        // Menghapus simbol koma dan titik dari budget limit
        $budgetLimit = str_replace(',', '', $validatedData['budget_limit']);
        $budgetLimit = str_replace('.', '', $budgetLimit);

        // Menyimpan nilai pagu dan budget limit yang telah diformat ke dalam database sebagai string
        $validatedData['nilai_pagu'] = $nilaiPagu;
        $validatedData['budget_limit'] = $budgetLimit;

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
