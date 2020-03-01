<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProfessionsSkillsCategoriesTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professions_skills_categories_types', function (Blueprint $table) {
            $skill_types = config('rolemaster.profession_skill_type');

            Schema::create('professions_skills_categories_types', function (Blueprint $table) use ($skill_types) {
                $table->increments('id');
                $table->string('profession_id');
                $table->string('category_id');
                $table->enum('skill_type',$skill_types);
                $table->integer('number_of_ranges')->nullable();

                $table->foreign('profession_id')
                    ->references('code')->on('professions')
                    ->onDelete('cascade');
                $table->foreign('category_id')
                    ->references('code')->on('skill_categories')
                    ->onDelete('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professions_skills_categories_types');
    }
}
