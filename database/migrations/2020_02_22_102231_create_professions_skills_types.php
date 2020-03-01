<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionsSkillsTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professions_skills_types', function (Blueprint $table) {
            Schema::dropIfExists('professions_skills');

            $skill_types = config('rolemaster.profession_skill_type');

            Schema::create('professions_skills_types', function (Blueprint $table) use ($skill_types) {
                $table->increments('id');
                $table->string('profession_id');
                $table->string('skill_id');
                $table->enum('skill_type',$skill_types);
                $table->integer('skill_set')->nullable();

                $table->foreign('profession_id')
                    ->references('code')->on('professions')
                    ->onDelete('cascade');
                $table->foreign('skill_id')
                    ->references('code')->on('skills')
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
        Schema::dropIfExists('professions_skills_types');
    }
}
