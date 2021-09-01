<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyPublikasiKategoriShow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publikasi_kategori_show', function (Blueprint $table) {
            $table->foreign('id_publikasi')->references('id')->on('publikasis')->onDelete('cascade');
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
        Schema::table('publikasi_kategori_show', function (Blueprint $table) {
            $table->dropForeign('id_publikasi'); 
            $table->dropIndex('id_publikasi');

            $table->dropForeign('id_kategori_show'); 
            $table->dropIndex('id_kategori_show');
        });
    }
}
