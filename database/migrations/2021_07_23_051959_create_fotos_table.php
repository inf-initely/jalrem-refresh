<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos', function (Blueprint $table) {
            $table->id();
            $table->string('judul_indo');
            $table->longText('konten_indo');
            $table->string('judul_english')->nullable();
            $table->longText('konten_english')->nullable();
            $table->string('thumbnail');
            $table->unsignedInteger('id_lokasi');
            $table->string('penulis');
            $table->string('contributor')->nullable();
            $table->json('slider_foto');
            $table->string('slider_file')->nullable();
            $table->boolean('slider_utama')->default(false);
            $table->enum('status', ['publikasi', 'draft']);
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
        Schema::dropIfExists('fotos');
    }
}
