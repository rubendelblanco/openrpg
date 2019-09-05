<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpellListCosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spell_list_dps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('spell_user_type')->unique();
            $table->json('own_reign');
            $table->json('other_reign');
            $table->boolean('is_editable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spell_list_dps');
    }
}
