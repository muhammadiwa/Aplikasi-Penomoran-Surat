<?php

namespace App\Models;

use App\Models\Surat;
use App\Models\Instansi;
use App\Models\Perusahaan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projek extends Model
{
    use HasFactory;

    protected $table = 'projek';

    protected $fillable = [
        'nama',
        'no_projek',
        'id_projek',
        'id_instansi',
        'id_perusahaan',
        'nilai_pagu',
        'id_tahapan',
        'nilai_spk',
        'budget_limit',
        'keterangan',
    ];

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi');
    }
    
    public function tahapan()
    {
        return $this->belongsTo(Tahapan::class, 'id_tahapan');
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan');
    }
    
}
