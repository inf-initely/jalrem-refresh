<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnTypeKerjasamaKategoriShow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kerjasama_kategori_show', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kerjasama')->change();
            $table->unsignedBigInteger('id_kategori_show')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kerjasama_kategori_show', function (Blueprint $table) {
            //
        });
    }
}
