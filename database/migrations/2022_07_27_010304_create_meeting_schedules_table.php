<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pic_rapat');
            $table->date('tanggal_rapat');
            $table->timestamps();
        });

        //Set Foreign Key di kolom meeting_id pada tabel meeting_materials
        Schema::table('meeting_materials', function (Blueprint $table) {
            $table->foreign('meeting_id')->references('id')->on('meeting_schedules')->onDelete('cascade')->onUpdate('cascade');
        });

        //Set Foreign Key di kolom meeting_id pada tabel memos
        Schema::table('memos', function (Blueprint $table) {
            $table->foreign('meeting_id')->references('id')->on('meeting_schedules')->onDelete('cascade')->onUpdate('cascade');
        });

        //Set Foreign Key di kolom meeting_id pada tabel discussion_statuses
        Schema::table('discussion_statuses', function (Blueprint $table) {
            $table->foreign('meeting_id')->references('id')->on('meeting_schedules')->onDelete('cascade')->onUpdate('cascade');
        });

        //Set Foreign Key di kolom meeting_id pada tabel memo_statuses
        Schema::table('memo_statuses', function (Blueprint $table) {
            $table->foreign('meeting_id')->references('id')->on('meeting_schedules')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Drop Foreign Key di kolom meeting_id di tabel meeting_materials
        Schema::table('meeting_materials', function (Blueprint $table) {
            $table->dropForeign('meeting_materials_meeting_id_foreign');
        });

        //Drop Foreign Key di kolom meeting_id di tabel memos
        Schema::table('memos', function (Blueprint $table) {
            $table->dropForeign('memos_meeting_id_foreign');
        });

        //Drop Foreign Key di kolom meeting_id di tabel discussion_statuses
        Schema::table('discussion_statuses', function (Blueprint $table) {
            $table->dropForeign('discussion_statuses_meeting_id_foreign');
        });

        //Drop Foreign Key di kolom meeting_id di tabel memo_statuses
        Schema::table('memo_statuses', function (Blueprint $table) {
            $table->dropForeign('memo_statuses_id_foreign');
        });

        Schema::dropIfExists('meeting_schedules');
    }
}
