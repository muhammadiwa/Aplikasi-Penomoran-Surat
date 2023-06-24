<?php

namespace App\Models;

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
        'id_instansi',
        'id_perusahaan',
        'keterangan',
    ];

    /**
     * Menyatakan relasi dengan tabel "instansi".
     */
    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi');
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan');
    }

}
