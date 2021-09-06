<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnglishRempahColumnToRempahs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rempahs', function (Blueprint $table) {
            $table->string('jenis_rempah_english')->after('jenis_rempah')->nullable();
            $table->string('keterangan_english')->after('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rempahs', function (Blueprint $table) {
            Schema::dropColumn('jenis_rempah_english');
            Schema::dropColumn('keterangan_english');
        });
    }
}
