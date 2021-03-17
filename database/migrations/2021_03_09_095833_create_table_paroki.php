<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableParoki extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Paroki', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_paroki');
            $table->integer('id_romo_paroki')->unsigned()->nullable();
            $table->foreign('id_romo_paroki')->references('id')->on('Admin');
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
        Schema::dropIfExists('Paroki');
    }
}
