<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAudioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio', function (Blueprint $table) {
            $table->id();
            $table->string('judul_indo');
            $table->longText('konten_indo');
            // $table->text('meta_indo');
            // $table->string('keywords_indo');
            $table->string('judul_english')->nullable();
            $table->longText('konten_english')->nullable();
            // $table->text('meta_english')->nullable();
            // $table->string('keywords_english')->nullable();
            $table->unsignedInteger('id_lokasi');
            $table->string('penulis');
            $table->string('cloud_key');
            $table->string('contributor')->nullable();
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
        Schema::dropIfExists('audio');
    }
}
