<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyArtikelKategoriShow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artikel_kategori_show', function (Blueprint $table) {
            $table->foreign('id_artikel')->references('id')->on('artikels')->onDelete('cascade');
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
        Schema::table('artikel_kategori_show', function (Blueprint $table) {
            $table->dropForeign('id_artikel'); 
            $table->dropIndex('id_artikel');

            $table->dropForeign('id_kategori_show'); 
            $table->dropIndex('id_kategori_show');
        });
    }
}
