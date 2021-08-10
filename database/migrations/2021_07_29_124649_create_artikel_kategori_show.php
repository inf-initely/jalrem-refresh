<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelKategoriShow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikel_kategori_show', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_artikel');
            $table->unsignedInteger('id_kategori_show');
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
        Schema::dropIfExists('artikel_kategori_show');
    }
}
