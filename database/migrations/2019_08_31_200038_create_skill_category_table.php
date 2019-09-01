<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->string('stats');
            $table->enum('progression',['standard','limited','combined','special']);
            $table->boolean('is_sortable');
            $table->boolean('is_editable');
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('skill_categories_id')->unsigned();
            $table->string('name');
            $table->mediumText('description');
            $table->foreign('skill_categories_id')
            ->references('id')->on('skill_categories')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skill_categories');
        Schema::dropIfExists('skills');
    }
}
