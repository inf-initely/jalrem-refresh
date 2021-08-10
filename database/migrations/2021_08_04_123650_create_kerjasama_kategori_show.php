<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKerjasamaKategoriShow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerjasama_kategori_show', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_kerjasama');
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
        Schema::dropIfExists('kerjasama_kategori_show');
    }
}
