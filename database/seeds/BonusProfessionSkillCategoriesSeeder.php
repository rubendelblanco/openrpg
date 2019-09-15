<?php

use Illuminate\Database\Seeder;

class BonusProfessionSkillCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Bardo' => [
                'Autoc' => 5,
                'Comun' => 5,
                'DesFis' => 5,
                'Infl' => 5,
                'PerPod' => 5
            ]
        ];
        $professions_map = DB::table('professions')->pluck('id', 'name');

        foreach ($data as $prof => $categories) {
            foreach ($categories as $cat => $bonus) {
                DB::table('bonus_profession_skill_category')->insert(
                    [
                        'skill_category_id' => $cat,
                        'profession_id' => $professions_map[$prof],
                        'bonus' => $bonus,
                    ]
                );
            }
        }
    }
}
