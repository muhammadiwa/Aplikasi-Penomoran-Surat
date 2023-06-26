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
        Schema::table('projek', function (Blueprint $table) {
            $table->string('nilai_pagu');
            $table->string('id_tahapan');
            $table->string('nilai_spk');
            $table->string('budget_limit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projek', function (Blueprint $table) {
            $table->dropColumn('nilai_pagu');
            $table->dropColumn('id_tahapan');
            $table->dropColumn('nilai_spk');
            $table->dropColumn('budget_limit');
        });
    }
};
