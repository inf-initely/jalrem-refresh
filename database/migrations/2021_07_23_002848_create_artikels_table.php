<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->string('judul_indo');
            $table->longText('konten_indo');
            $table->text('meta_indo')->nullable();
            $table->string('keywords_indo')->nullable();
            $table->string('judul_english')->nullable();
            $table->longText('konten_english')->nullable();
            $table->text('meta_english')->nullable();
            $table->string('keywords_english')->nullable();
            $table->string('slug');
            $table->string('thumbnail');
            $table->unsignedInteger('id_lokasi')->nullable();
            $table->enum('penulis', ['admin', 'kontributor umum/pamong budaya']);
            $table->unsignedInteger('id_kontributor')->nullable();
            $table->enum('contributor', ['umum', 'pamong budaya'])->nullable();
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
        Schema::dropIfExists('artikels');
    }
}
