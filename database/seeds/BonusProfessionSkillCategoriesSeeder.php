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
                'Autoc' => [5,'2/7'],
                'Comun' => [5,'1/1/1'],
                'DesFis' => [5,'6/14'],
                'Infl' => [5,'1/4'],
                'PerPod' => [5,'3/6']
            ]
        ];
        $professions_map = DB::table('professions')->pluck('code', 'name');

        foreach ($data as $prof => $categories) {
            foreach ($categories as $cat => $bonus) {
                DB::table('bonus_profession_skill_category')->insert(
                    [
                        'skill_category_id' => $cat,
                        'profession_id' => $professions_map[$prof],
                        'bonus' => $bonus[0],
                        'dp' => $bonus[1],
                    ]
                );
            }
        }
    }
}
