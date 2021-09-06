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
            $table->foreign('id_kategori_show')->references('id')->on('kategori_shows')->onDelete('cascade');
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
            $table->dropForeign('id_kerjasama'); 
            $table->dropIndex('id_kerjasama');

            $table->dropForeign('id_kategori_show'); 
            $table->dropIndex('id_kategori_show');
        });
    }
}
