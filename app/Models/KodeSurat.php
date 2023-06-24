<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeSurat extends Model
{
    use HasFactory;

    protected $table = 'kode_surat';

    protected $fillable = [
        'nama',
        'kode_surat',
    ];
}
