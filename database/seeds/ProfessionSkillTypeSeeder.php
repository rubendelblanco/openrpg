<?php

use Illuminate\Database\Seeder;

class ProfessionSkillTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('professions_skills')->insert([
            'profession_id' => 'bardo',
            'skill_id' => 'sentido_del_tiempo',
            'type' => 'everyman'
        ]);
    }
}
