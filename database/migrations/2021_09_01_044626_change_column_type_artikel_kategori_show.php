<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnTypeArtikelKategoriShow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artikel_kategori_show', function (Blueprint $table) {
            $table->unsignedBigInteger('id_artikel')->change();
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
        Schema::table('artikel_kategori_show', function (Blueprint $table) {
            //
        });
    }
}
