<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnNamaDomisiliUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama');
            $table->bigInteger('domisili');
        });

        // Schema::table('users', function (Blueprint $table) {
        //     $table->foreign('domisili')->references('id')->on('lokasis')->onDelete()
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nama');
            $table->dropColumn('domisili');
        });
    }
}
