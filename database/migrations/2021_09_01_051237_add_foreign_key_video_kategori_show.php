<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyVideoKategoriShow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('video_kategori_show', function (Blueprint $table) {
            $table->foreign('id_video')->references('id')->on('videos')->onDelete('cascade');
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
        Schema::table('video_kategori_show', function (Blueprint $table) {
            $table->dropForeign('id_video'); 
            $table->dropIndex('id_video');

            $table->dropForeign('id_kategori_show'); 
            $table->dropIndex('id_kategori_show');
        });
    }
}
