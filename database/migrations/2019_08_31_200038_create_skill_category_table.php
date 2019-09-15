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
            $table->string('skill_category_id');
            $table->string('name');
            $table->string('code')->unique();
            $table->mediumText('description');
            
            $table->foreign('skill_category_id')
            ->references('code')->on('skill_categories')
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
        Schema::dropIfExists('skills');
        Schema::dropIfExists('skill_categories');
    }
}
