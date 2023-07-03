<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kode_surat')->constrained('kode_surat');
            $table->foreignId('id_projek')->constrained('projek');
            $table->foreignId('id_perusahaan')->constrained('projek');
            $table->foreignId('id_instansi')->constrained('projek');
            $table->string('id_bulan');
            $table->string('id_tahun');
            $table->text('keterangan');
            $table->text('keterangan_projek');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat');
    }
};
