<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyKategoriShowPublikasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publikasis', function (Blueprint $table) {
            // $table->foreign('id')->references('id_publikasi')->on('publikasi_kategori_show')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('publikasis', function (Blueprint $table) {
            //
        });
    }
}
