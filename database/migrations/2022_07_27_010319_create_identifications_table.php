<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sk_id')->unsigned();
            $table->string('komtek');
            $table->longText('sekre_komtek');
            $table->timestamps();
        });

        //Set Foreign Key di kolom identifikasi_id pada tabel standard_implementers
        Schema::table('standard_implementers', function (Blueprint $table) {
            $table->foreign('identifikasi_id')->references('id')->on('identifications')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Drop Foreign Key di kolom identifikasi_id di tabel standard_implementers
        Schema::table('standard_implementers', function (Blueprint $table) {
            $table->dropForeign('standard_implementers_identifikasi_id_foreign');
        });

        Schema::dropIfExists('identifications');
    }
}
