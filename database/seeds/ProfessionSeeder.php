<?php

use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Bardo',
            'stat1' => 'Me',
            'stat2' => 'Pr',
            'spell_realms' => json_encode(['Men','Ese'])
        ];
        DB::table('professions')->insert($data);
    }
}


