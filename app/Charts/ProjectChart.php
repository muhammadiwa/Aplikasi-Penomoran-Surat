<?php

namespace App\Charts;

use App\Models\Surat;
use App\Models\Projek;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ProjectChart
{
    protected $chart;

    public function __construct()
    {
        $this->chart = new LarapexChart;
    }

    public function build($perusahaanData)
    {
        $data = [];
        $labels = [];

        foreach ($perusahaanData as $perusahaan) {
            $projekCount = Projek::where('id_perusahaan', $perusahaan->id)->count();
            $data[] = $projekCount;
            $labels[] = $perusahaan->nama;
        }

        return $this->chart->barChart()
            ->setTitle('Data Projek Perusahaan')
            ->setSubtitle(date('Y'))
            ->addData('Jumlah Projek', $data)
            ->setLabels($labels)
            ->setColors(['#4e73df', '#1cc88a', '#36b9cc']);
    }

    public function buildSurat($perusahaanData)
    {
        $data = [];
        $labels = [];

        foreach ($perusahaanData as $perusahaan) {
            $suratCount = Surat::where('id_perusahaan', $perusahaan->id)->count();
            $data[] = $suratCount;
            $labels[] = $perusahaan->nama;
        }

        return $this->chart->pieChart()
            ->setTitle('Data Surat Perusahaan')
            ->setSubtitle(date('Y'))
            ->addData($data)
            ->setLabels($labels)
            ->setColors(['#FF0303', '#0d9bac', '#0E6FBC', '#FFDEB9']);
    }
}
