<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meeting_id')->unsigned();
            $table->string('nmr_nodin');
            $table->integer('jenis_nodin');
            $table->string('nmr_kepka')->nullable();
            $table->timestamps();
        });

        //Set Foreign Key di kolom memo_id pada tabel memo_histories
        Schema::table('memo_histories', function (Blueprint $table) {
            $table->foreign('memo_id')->references('id')->on('memos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Drop Foreign Key di kolom memo_id di tabel memo_histories
        Schema::table('memo_histories', function (Blueprint $table) {
            $table->dropForeign('memo_histories_memo_id_foreign');
        });

        Schema::dropIfExists('memos');
    }
}
