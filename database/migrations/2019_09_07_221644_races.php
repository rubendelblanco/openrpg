<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Races extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('races', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->json('stats');
            $table->integer('lifespan');
            $table->integer('background_points');
            $table->json('resistance_rolls');
            $table->string('body_development');
            $table->string('arcane_pp');
            $table->string('essence_pp');
            $table->string('channeling_pp');
            $table->string('mentalism_pp');
            $table->enum('size', ['very_small', 'small', 'medium', 'big', 'very_big']);
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
        Schema::dropIfExists('races');
    }
}
