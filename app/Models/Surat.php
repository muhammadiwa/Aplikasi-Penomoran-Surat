<?php

namespace App\Models;

use App\Models\Projek;
use App\Models\Instansi;
use App\Models\KodeSurat;
use App\Models\Perusahaan;
use Illuminate\Foundation\Auth\User;
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
        'id_instansi',
        'id_perusahaan',
        'bulan',
        'keterangan',
        'keterangan_projek',
        'user_id',
    ];

    public function kode_surat()
    {
        return $this->belongsTo(KodeSurat::class, 'kode_surat');
    }

    public function projek()
    {
        return $this->belongsTo(Projek::class, 'id_projek');
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi');
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
