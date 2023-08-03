<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewStandardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_standards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sk_id')->unsigned();
            $table->string('nmr_std');
            $table->longText('jdl_std');
            $table->year('tahun_std');
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
        Schema::dropIfExists('new_standards');
    }
}
