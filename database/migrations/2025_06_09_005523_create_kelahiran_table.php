<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelahirans', function (Blueprint $table) {
            $table->id();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->time('jam_lahir');
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->float('panjang', 4, 2); // panjang dalam cm, misal 50.5
            $table->float('berat', 4, 2); // berat dalam kg, misal 3.2
            $table->string('ayah');
            $table->string('ibu');
            $table->integer('anak_ke');
            $table->string('jenis_kelahiran');
            $table->string('penolong_kelahiran');
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
        Schema::dropIfExists('kelahirans');
    }
};
