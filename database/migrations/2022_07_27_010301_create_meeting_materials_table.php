<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meeting_id')->unsigned();
            $table->integer('old_std_id')->unsigned();
            $table->timestamps();
        });

        //Set Foreign Key di kolom material_id pada tabel transition_times
        Schema::table('transition_times', function (Blueprint $table) {
            $table->foreign('material_id')->references('id')->on('meeting_materials')->onDelete('cascade')->onUpdate('cascade');
        });

        //Set Foreign Key di kolom material_id pada tabel discussion_results
        Schema::table('discussion_results', function (Blueprint $table) {
            $table->foreign('material_id')->references('id')->on('meeting_materials')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Drop Foreign Key di kolom material_id di tabel transition_times
        Schema::table('transition_times', function (Blueprint $table) {
            $table->dropForeign('transition_times_material_id_foreign');
        });

        //Drop Foreign Key di kolom material_id di tabel discussion_results
        Schema::table('discussion_results', function (Blueprint $table) {
            $table->dropForeign('discussion_results_material_id_foreign');
        });

        Schema::dropIfExists('meeting_materials');
    }
}
