<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyAudioKategoriShow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('audio_kategori_show', function (Blueprint $table) {
            $table->foreign('id_audio')->references('id')->on('audio')->onDelete('cascade');
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
        Schema::table('audio_kategori_show', function (Blueprint $table) {
            $table->dropForeign('id_audio'); 
            $table->dropIndex('id_audio');

            $table->dropForeign('id_kategori_show'); 
            $table->dropIndex('id_kategori_show');
        });
    }
}
