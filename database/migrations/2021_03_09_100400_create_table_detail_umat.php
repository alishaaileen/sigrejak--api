<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDetailUmat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Detail_Umat', function (Blueprint $table) {
            $table->integer('id_umat')->unsigned();
            $table->foreign('id_umat')->references('id')->on('Umat');
            $table->date('tgl_baptis')->nullable();
            $table->date('tgl_komuni')->nullable();
            $table->date('tgl_penguatan')->nullable();
            $table->string('cara_menikah')->nullable();
            $table->date('tgl_menikah')->nullable();
            $table->string('file_akta_lahir')->nullable();
            $table->string('file_ktp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Detail_Umat');
    }
}
