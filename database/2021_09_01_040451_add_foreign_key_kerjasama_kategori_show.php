<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyKerjasamaKategoriShow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kerjasama_kategori_show', function (Blueprint $table) {
            $table->foreign('id_kerjasama')->references('id')->on('kerjasamas')->onDelete('cascade');
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
