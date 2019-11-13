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
        $spell_user_types = config('rolemaster.spell_user');
        Schema::create('professions', function (Blueprint $table) use ($stats_list, $spell_user_types) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->enum('stat1', $stats_list);
            $table->enum('stat2', $stats_list);
            $table->json('spell_realms')->nullable();
            $table->enum('spell_user_type', $spell_user_types);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professions');
    }
}
