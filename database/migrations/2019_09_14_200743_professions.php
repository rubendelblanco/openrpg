<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Professions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        $stats_list = config('rolemaster.stats_codes');
        Schema::create('professions', function (Blueprint $table) use ($stats_list) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->enum('stat1', $stats_list);
            $table->enum('stat2', $stats_list);
            $table->json('spell_realms');
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
