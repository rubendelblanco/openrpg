<?php

use Illuminate\Database\Seeder;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $races = [
            [
                'name' => 'Hombres Mixtos',
                'stats' => [
                    'Co' => 2,
                    'Ad' => 2,
                    'Fu' => 2
                ],
                'lifespan' => 150,
                'background_points' => 5,
                'resistance_rolls' => [
                    'Can' => '-5',
                    'Ese' => '-5',
                    'Men' => '-5'
                ],
                'body_development' => '0/6/5/2/1',
                'arcane_pp' => '0/6/5/4/3',
                'essence_pp' => '0/6/5/4/3',
                'channeling_pp' => '0/6/5/4/3',
                'mentalism_pp' => '0/7/6/5/4',
                'size' => 'medium'
            ]
        ];

        foreach ($races as $race) {
            $data = [];

            foreach ($race as $index => $value) {
                $data[$index] = (is_array($value) ? json_encode($value) : $value);
            }

            $data['is_editable'] = 0;
            DB::table('races')->insert($data);
        }
    }
}
