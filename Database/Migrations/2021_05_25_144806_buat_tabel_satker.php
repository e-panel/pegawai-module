<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelSatker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bidang', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->nullable();

            $table->string('label');
            $table->string('slug')->unique();

            $table->string('jabatan')->nullable();
            $table->text('tupoksi')->nullable();
            
            $table->string('status_layanan')->default(0);
            $table->integer('id_parent')->default(0);

            $table->integer('uptd')->default(0);
            $table->integer('sotk')->default(0);
            $table->string('sotk_file')->nullable();
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
        Schema::dropIfExists('bidang');
    }
}
