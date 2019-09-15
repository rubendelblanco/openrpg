<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'code' => Str::slug('Bardo'),
            'stat1' => 'Me',
            'stat2' => 'Pr',
            'spell_realms' => json_encode(['Men']),
            'spell_user_type' => 'semi'
        ];
        DB::table('professions')->insert($data);
    }
}


