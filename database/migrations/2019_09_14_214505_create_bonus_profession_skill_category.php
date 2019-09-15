<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonusProfessionSkillCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonus_profession_skill_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('skill_category_id');
            $table->string('profession_id');
            $table->integer('bonus')->default(0);
            $table->string('dp');
            
            $table->foreign('skill_category_id')
                ->references('code')->on('skill_categories')
                ->onDelete('cascade');
            $table->foreign('profession_id')
                ->references('code')->on('professions')
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
        Schema::dropIfExists('bonus_profession_skill_category');
    }
}
