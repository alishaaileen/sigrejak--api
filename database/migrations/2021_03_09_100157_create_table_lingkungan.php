<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLingkungan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Lingkungan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_lingkungan');
            $table->integer('id_ketua_lingkungan')->unsigned();
            $table->foreign('id_ketua_lingkungan')->references('id')->on('Keluarga');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Lingkungan');
    }
}
