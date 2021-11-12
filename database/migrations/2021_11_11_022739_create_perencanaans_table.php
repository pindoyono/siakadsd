<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerencanaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perencanaans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penilaian')->nullable();
            $table->integer('bobot')->default(0);
            $table->bigInteger('id_mapel')->default(0);
            $table->bigInteger('id_rombel')->default(0);
            $table->bigInteger('id_guru')->default(0);
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
        Schema::dropIfExists('perencanaans');
    }
}
