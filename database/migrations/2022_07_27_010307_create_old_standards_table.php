<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOldStandardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('old_standards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sk_id')->unsigned();
            $table->string('nmr_std');
            $table->longText('jdl_std');
            $table->timestamps();
        });

        //Set Foreign Key di kolom old_std_id pada tabel meeting_materials
        Schema::table('meeting_materials', function (Blueprint $table) {
            $table->foreign('old_std_id')->references('id')->on('old_standards')->onDelete('cascade')->onUpdate('cascade');
        });

        //Set Foreign Key di kolom old_std_id pada tabel meeting_material_statuses
        Schema::table('meeting_material_statuses', function (Blueprint $table) {
            $table->foreign('old_std_id')->references('id')->on('old_standards')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Drop Foreign Key di kolom old_std_id di tabel meeting_materials
        Schema::table('meeting_materials', function (Blueprint $table) {
            $table->dropForeign('meeting_materials_old_std_id_foreign');
        });

        //Drop Foreign Key di kolom old_std_id di tabel meeting_material_statuses
        Schema::table('meeting_material_statuses', function (Blueprint $table) {
            $table->dropForeign('meeting_material_statuses_old_std_id_foreign');
        });

        Schema::dropIfExists('old_standards');
    }
}
