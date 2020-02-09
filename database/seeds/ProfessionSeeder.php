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
        $professions = [
            [
                'name' => 'Bardo',
                'code' => Str::slug('Bardo'),
                'stat1' => 'Me',
                'stat2' => 'Pr',
                'stat3' => null,
                'stat4' => null,
                'stats_number' => 2,
                'spell_realms' => json_encode(['Men']),
                'spell_user_type' => 'semi'
            ],
            [
                'name' => 'Luchador',
                'code' => Str::slug('Luchador'),
                'stat1' => 'Co',
                'stat2' => 'Fu',
                'stat3' => null,
                'stat4' => null,
                'stats_number' => 2,
                'spell_realms' => null,
                'spell_user_type' => 'none'
            ],
            [
                'name' => 'Ladrón',
                'code' => Str::slug('Ladron'),
                'stat1' => 'Ag',
                'stat2' => 'Rp',
                'stat3' => null,
                'stat4' => null,
                'stats_number' => 2,
                'spell_realms' => null,
                'spell_user_type' => 'none'
            ],
            [
                'name' => 'Bribon',
                'code' => Str::slug('Bribon'),
                'stat1' => 'Ag',
                'stat2' => 'Fu',
                'stat3' => null,
                'stat4' => null,
                'stats_number' => 2,
                'spell_realms' => null,
                'spell_user_type' => 'none'
            ],
            [
                'name' => 'Clérigo',
                'code' => Str::slug('Clerigo'),
                'stat1' => 'In',
                'stat2' => 'Me',
                'stat3' => null,
                'stat4' => null,
                'stats_number' => 2,
                'spell_realms' => json_encode(['Can']),
                'spell_user_type' => 'pure'
            ],
            [
                'name' => 'Monje',
                'code' => Str::slug('Monje'),
                'stat1' => 'Ad',
                'stat2' => 'Em',
                'stat3' => null,
                'stat4' => null,
                'stats_number' => 2,
                'spell_realms' => json_encode(['Ese']),
                'spell_user_type' => 'semi'
            ],
            [
                'name' => 'Mago',
                'code' => Str::slug('Mago'),
                'stat1' => 'Em',
                'stat2' => 'Ra',
                'stat3' => null,
                'stat4' => null,
                'stats_number' => 2,
                'spell_realms' => json_encode(['Ese']),
                'spell_user_type' => 'pure'
            ],
            [
                'name' => 'Mentalista',
                'code' => Str::slug('Mentalista'),
                'stat1' => 'Pr',
                'stat2' => 'Ad',
                'stat3' => null,
                'stat4' => null,
                'stats_number' => 2,
                'spell_realms' => json_encode(['Men']),
                'spell_user_type' => 'pure'
            ],
            [
                'name' => 'Montaraz',
                'code' => Str::slug('Montaraz'),
                'stat1' => 'In',
                'stat2' => 'Co',
                'stat3' => null,
                'stat4' => null,
                'stats_number' => 2,
                'spell_realms' => json_encode(['Can']),
                'spell_user_type' => 'semi'
            ],
            [
                'name' => 'Indagador',
                'code' => Str::slug('Indagador'),
                'stat1' => 'Em',
                'stat2' => 'Ag',
                'stat3' => null,
                'stat4' => null,
                'stats_number' => 2,
                'spell_realms' => json_encode(['Ese']),
                'spell_user_type' => 'semi'
            ],
            [
                'name' => 'Cazamagos',
                'code' => Str::slug('Cazamagos'),
                'stat1' => 'Co',
                'stat2' => 'Em',
                'stat3' => 'In',
                'stat4' => 'Pr',
                'stats_number' => 4,
                'spell_realms' => json_encode(['Arc']),
                'spell_user_type' => 'semi'
            ],
            [
                'name' => 'Caótico',
                'code' => Str::slug('Caotico'),
                'stat1' => 'Co',
                'stat2' => 'Em',
                'stat3' => 'In',
                'stat4' => 'Pr',
                'stats_number' => 4,
                'spell_realms' => json_encode(['Arc']),
                'spell_user_type' => 'semi'
            ],
            [
                'name' => 'Taumaturgo',
                'code' => Str::slug('Taumaturgo'),
                'stat1' => 'Ad',
                'stat2' => 'Em',
                'stat3' => 'In',
                'stat4' => 'Pr',
                'stats_number' => 4,
                'spell_realms' => json_encode(['Arc']),
                'spell_user_type' => 'pure'
            ],
            [
                'name' => 'Arcano',
                'code' => Str::slug('Arcano'),
                'stat1' => 'Ad',
                'stat2' => 'Em',
                'stat3' => 'In',
                'stat4' => 'Pr',
                'stats_number' => 4,
                'spell_realms' => json_encode(['Arc']),
                'spell_user_type' => 'pure'
            ]
        ];

        foreach ($professions as $profession){
            DB::table('professions')->insert($profession);
        }
    }
}


