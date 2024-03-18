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
            $table->integer('kode_surat')->nullable();
            $table->integer('id_projek')->nullable();
            $table->integer('id_perusahaan')->nullable();
            $table->integer('id_instansi')->nullable();
            $table->string('no_urut');
            $table->string('bulan');
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
