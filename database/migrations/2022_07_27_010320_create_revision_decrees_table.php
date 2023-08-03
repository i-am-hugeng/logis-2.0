<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionDecreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision_decrees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pic_identifikasi');
            $table->string('nmr_sk');
            $table->longText('uraian_sk');
            $table->date('tgl_terbit_sk');
            $table->date('tgl_terima_sk');
            $table->timestamps();
        });

        //Set Foreign Key di kolom sk_id pada tabel new_standards
        Schema::table('new_standards', function (Blueprint $table) {
            $table->foreign('sk_id')->references('id')->on('revision_decrees')->onDelete('cascade')->onUpdate('cascade');
        });

        //Set Foreign Key di kolom sk_id pada tabel old_standards
        Schema::table('old_standards', function (Blueprint $table) {
            $table->foreign('sk_id')->references('id')->on('revision_decrees')->onDelete('cascade')->onUpdate('cascade');
        });

        //Set Foreign Key di kolom sk_id pada tabel standard_traits
        Schema::table('standard_traits', function (Blueprint $table) {
            $table->foreign('sk_id')->references('id')->on('revision_decrees')->onDelete('cascade')->onUpdate('cascade');
        });

        //Set Foreign Key di kolom sk_id pada tabel identification_statuses
        Schema::table('identification_statuses', function (Blueprint $table) {
            $table->foreign('sk_id')->references('id')->on('revision_decrees')->onDelete('cascade')->onUpdate('cascade');
        });

        //Set Foreign Key di kolom sk_id pada tabel identifications
        Schema::table('identifications', function (Blueprint $table) {
            $table->foreign('sk_id')->references('id')->on('revision_decrees')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Drop Foreign Key di kolom sk_id di tabel new_standards
        Schema::table('new_standards', function (Blueprint $table) {
            $table->dropForeign('new_standards_sk_id_foreign');
        });

        //Drop Foreign Key di kolom sk_id di tabel old_standards
        Schema::table('old_standards', function (Blueprint $table) {
            $table->dropForeign('old_standards_sk_id_foreign');
        });

        //Drop Foreign Key di kolom sk_id di tabel standard_traits
        Schema::table('standard_traits', function (Blueprint $table) {
            $table->dropForeign('standard_traits_sk_id_foreign');
        });

        //Drop Foreign Key di kolom sk_id di tabel identification_statuses
        Schema::table('identification_statuses', function (Blueprint $table) {
            $table->dropForeign('identification_statuses_sk_id_foreign');
        });

        //Drop Foreign Key di kolom sk_id di tabel identifications
        Schema::table('identifications', function (Blueprint $table) {
            $table->dropForeign('identifications_sk_id_foreign');
        });

        Schema::dropIfExists('revision_decrees');
    }
}
