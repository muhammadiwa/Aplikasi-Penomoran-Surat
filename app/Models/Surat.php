<?php

namespace App\Models;

use App\Models\Bulan;
use App\Models\Tahun;
use App\Models\Projek;
use App\Models\Instansi;
use App\Models\KodeSurat;
use App\Models\Perusahaan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat';

    protected $fillable = [
        'kode_surat',
        'id_projek',
        'no_urut',
        'id_perusahaan',
        'id_bulan',
        'id_tahun',
        'keterangan',
        'keterangan_projek',
    ];

    public function bulan()
    {
        return $this->belongsTo(Bulan::class, 'id_bulan');
    }

    public function tahun()
    {
        return $this->belongsTo(Tahun::class, 'id_tahun');
    }

    public function kode_surat()
    {
        return $this->belongsTo(KodeSurat::class, 'kode_surat');
    }

    public function projek()
    {
        return $this->belongsTo(Projek::class, 'id_projek');
    }

}
