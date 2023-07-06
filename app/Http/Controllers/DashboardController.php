<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Surat;
use App\Models\Projek;
use App\Models\Instansi;
use App\Models\Perusahaan;
use App\Charts\ProjectChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            // User is authenticated, fetch project data
            $projek = Projek::count();
            $instansi = Instansi::count();
            $surat = Surat::count();
            $karyawan = User::count();

            // Fetch data for project chart
            $perusahaanData = Perusahaan::all();
            $chart = (new ProjectChart)->build($perusahaanData);
            $chartSurat = (new ProjectChart)->buildSurat($perusahaanData);

            // Pass the data to the view
            $data = [
                'projek' => $projek,
                'instansi' => $instansi,
                'karyawan' => $karyawan,
                'surat' => $surat,
                'chart' => $chart,
                'chartSurat' => $chartSurat,
            ];

            return view('dashboard')->with($data);
        } else {
            // User is not authenticated, redirect to the login page
            return redirect()->route('login');
        }
    }
}
