<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CulturesSkills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('culture_skill_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('skill_category_id')->unsigned();
            $table->integer('culture_id')->unsigned();
            $table->string('ranks');
        });

        Schema::create('culture_skill', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('skill_id')->unsigned();
            $table->integer('culture_id')->unsigned();
            $table->string('ranks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('culture_skill_category');
        Schema::dropIfExists('culture_skill');
    }
}
