<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personil', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');

            $table->string('foto')->nullable();
            $table->string('nama')->nullable();
            $table->string('nip')->nullable();

            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('golongan')->nullable();
            $table->text('alamat')->nullable();
            $table->text('tupoksi')->nullable();

            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('plain')->nullable();

            $table->string('id_bidang')->nullable();
            $table->string('id_jabatan')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('personil');
    }
}
