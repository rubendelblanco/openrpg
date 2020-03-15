<?php

use Illuminate\Database\Seeder;

class ProfessionSkillsCategoriesTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'profession_id' => 'alquimista-de-mentalismo',
                'category_id' => 'Ofi',
                'skill_type'=>'occupational',
                'number_of_ranges'=>6
            ],
            [
                'profession_id' => 'alquimista-de-canalizacion',
                'category_id' => 'Ofi',
                'skill_type'=>'occupational',
                'number_of_ranges'=>6
            ],
            [
                'profession_id' => 'alquimista-de-esencia',
                'category_id' => 'Ofi',
                'skill_type'=>'occupational',
                'number_of_ranges'=>6
            ],
            [
                'profession_id' => 'monje-guerrero',
                'category_id' => 'ManCom',
                'skill_type'=>'everyman',
                'number_of_ranges'=>1
            ],
            [
                'profession_id' => 'luchador',
                'category_id' => 'ManCom',
                'skill_type'=>'everyman',
                'number_of_ranges'=>1
            ]
        ];

        foreach ($categories as $category) {
            try {
                DB::table('professions_skills_categories_types')->insert($category);
            }
            catch (Exception $e) {
                //just go on!
            }
        }
    }
}
