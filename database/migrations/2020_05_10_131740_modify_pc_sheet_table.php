<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPcSheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pc_sheet');
        Schema::create('pc_sheets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('character_id');
            $table->string('key');
            $table->json('value');
            $table->foreign('character_id')->references('id')
                ->on('characters')->onDelete('cascade');
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
        //
    }
}
