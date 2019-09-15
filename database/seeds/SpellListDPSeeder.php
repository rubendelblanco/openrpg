<?php

use Illuminate\Database\Seeder;

class SpellListDPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spell_users = [
            [
                'spell_user_type' => 'pure',
                'own_realm' => [
                    'basics' => [
                        '5' => '3/3/3',
                        '10' => '3/3/3',
                        '15' => '3/3/3',
                        '20' => '3/3/3',
                        '21' => '3/3/3'
                    ],
                    'open' => [
                        '5' => '4/4/4',
                        '10' => '4/4/4',
                        '15' => '4/4/4',
                        '20' => '4/4/4',
                        '21' => '6/6/6'
                    ],
                    'closed' => [
                        '5' => '4/4/4',
                        '10' => '4/4/4',
                        '15' => '4/4/4',
                        '20' => '4/4/4',
                        '21' => '8/8'
                    ],
                    'other' => [
                        '5' => '8/8',
                        '10' => '10/10',
                        '15' => '12',
                        '20' => '25',
                        '21' => '40'
                    ],
                    'training' => [
                        '5' => '4/4/4',
                        '10' => '4/4/4',
                        '15' => '4/4/4',
                        '20' => '4/4/4',
                        '21' => '4/4/4'
                    ]
                ],
                'other_realm' => [
                    'open' => [
                        '5' => '10/10',
                        '10' => '12',
                        '15' => '25',
                        '20' => '40',
                        '21' => '60'
                    ],
                    'closed' => [
                        '5' => '20',
                        '10' => '25',
                        '15' => '40',
                        '20' => '60',
                        '21' => '80'
                    ],
                    'other' => [
                        '5' => '50',
                        '10' => '70',
                        '15' => '90',
                        '20' => '110',
                        '21' => '130'
                    ],
                    'training' => [
                        '5' => '8/8/8',
                        '10' => '8/8/8',
                        '15' => '8/8/8',
                        '20' => '8/8/8',
                        '21' => '8/8/8'
                    ],
                    'arcane' => [
                        '5' => '6/6',
                        '10' => '8/8',
                        '15' => '10/10',
                        '20' => '12',
                        '21' => '25'
                    ]
                ]
            ],
            [
                'spell_user_type' => 'semi',
                'own_realm' => [
                    'basics' => [
                        '5' => '6/6/6',
                        '10' => '6/6/6',
                        '15' => '6/6/6',
                        '20' => '6/6/6',
                        '21' => '6/6/6'
                    ],
                    'open' => [
                        '5' => '8/8',
                        '10' => '8/8',
                        '15' => '12',
                        '20' => '18',
                        '21' => '25'
                    ],
                    'closed' => [
                        '5' => '10/10',
                        '10' => '12',
                        '15' => '25',
                        '20' => '40',
                        '21' => '60'
                    ],
                    'other' => [
                        '5' => '25',
                        '10' => '40',
                        '15' => '60',
                        '20' => '80',
                        '21' => '100'
                    ],
                    'training' => [
                        '5' => '6/6/6',
                        '10' => '6/6/6',
                        '15' => '6/6/6',
                        '20' => '6/6/6',
                        '21' => '6/6/6'
                    ]
                ],
                'other_realm' => [
                    'open' => [
                        '5' => '30',
                        '10' => '60',
                        '15' => '80',
                        '20' => '100',
                        '21' => '120'
                    ],
                    'closed' => [
                        '5' => '45',
                        '10' => '60',
                        '15' => '80',
                        '20' => '100',
                        '21' => '120'
                    ],
                    'other' => [
                        '5' => '80',
                        '10' => '100',
                        '15' => '120',
                        '20' => '140',
                        '21' => '160'
                    ],
                    'training' => [
                        '5' => '12/12',
                        '10' => '12/12',
                        '15' => '12/12',
                        '20' => '12/12',
                        '21' => '12/12'
                    ],
                    'arcane' => [
                        '5' => '12',
                        '10' => '25',
                        '15' => '40',
                        '20' => '60',
                        '21' => '80'
                    ]
                ]
            ],
            [
                'spell_user_type' => 'hybrid',
                'own_realm' => [
                    'basics' => [
                        '5' => '3/3/3',
                        '10' => '3/3/3',
                        '15' => '3/3/3',
                        '20' => '3/3/3',
                        '21' => '3/3/3'
                    ],
                    'open' => [
                        '5' => '4/4/4',
                        '10' => '4/4/4',
                        '15' => '6/6/6',
                        '20' => '8/8',
                        '21' => '12'
                    ],
                    'closed' => [
                        '5' => '4/4/4',
                        '10' => '6/6/6',
                        '15' => '8/8',
                        '20' => '10/10',
                        '21' => '25'
                    ],
                    'other' => [
                        '5' => '10/10',
                        '10' => '12',
                        '15' => '25',
                        '20' => '40',
                        '21' => '60'
                    ],
                    'training' => [
                        '5' => '4/4/4',
                        '10' => '4/4/4',
                        '15' => '4/4/4',
                        '20' => '4/4/4',
                        '21' => '4/4/4'
                    ]
                ],
                'other_realm' => [
                    'open' => [
                        '5' => '12',
                        '10' => '25',
                        '15' => '40',
                        '20' => '60',
                        '21' => '80'
                    ],
                    'closed' => [
                        '5' => '25',
                        '10' => '40',
                        '15' => '60',
                        '20' => '80',
                        '21' => '100'
                    ],
                    'other' => [
                        '5' => '60',
                        '10' => '80',
                        '15' => '100',
                        '20' => '120',
                        '21' => '140'
                    ],
                    'training' => [
                        '5' => '8/8/8',
                        '10' => '8/8/8',
                        '15' => '8/8/8',
                        '20' => '8/8/8',
                        '21' => '8/8/8'
                    ],
                    'arcane' => [
                        '5' => '5/5',
                        '10' => '6/6',
                        '15' => '8/8',
                        '20' => '10/10',
                        '21' => '12'
                    ]
                ]
            ]
        ];

        $non_spell_users = [
            [
                'spell_user_type' => 'ladron',
                'own_realm' => [
                    'open' => '18',
                    'closed' => '35',
                    'other' => '70',
                    'training' => '8/8/8'
                ],
                'other_realm' => [
                    'open' => '80',
                    'closed' => '100',
                    'other' => '70',
                    'training' => '16/16',
                    'arcane' => '22'
                ]
            ],
            [
                'spell_user_type' => 'luchador',
                'own_realm' => [
                    'open' => '25',
                    'closed' => '40',
                    'other' => '80',
                    'training' => '8/8/8'
                ],
                'other_realm' => [
                    'open' => '90',
                    'closed' => '105',
                    'other' => '80',
                    'training' => '16/16',
                    'arcane' => '30'
                ]
            ],
            [
                'spell_user_type' => 'bribon',
                'own_realm' => [
                    'open' => '15',
                    'closed' => '25',
                    'other' => '50',
                    'training' => '8/8/8'
                ],
                'other_realm' => [
                    'open' => '60',
                    'closed' => '90',
                    'other' => '50',
                    'training' => '16/16',
                    'arcane' => '20'
                ]
            ],
            [
                'spell_user_type' => 'monje_guerrero',
                'own_realm' => [
                    'open' => '20',
                    'closed' => '30',
                    'other' => '60',
                    'training' => '8/8/8'
                ],
                'other_realm' => [
                    'open' => '70',
                    'closed' => '105',
                    'other' => '95',
                    'training' => '16/16',
                    'arcane' => '25'
                ]
            ]

        ];

        foreach ($spell_users as $row) {
            $this->insert_row($row);
        }

        foreach ($non_spell_users as $non_spell_user) {
            $row = [];
            $row['spell_user_type'] = $non_spell_user['spell_user_type'];
            $row['own_realm'] = $this->fill_dp($non_spell_user['own_realm']);
            $row['other_realm'] = $this->fill_dp($non_spell_user['other_realm']);
            $this->insert_row($row);
        }
    }

    private function insert_row($row){
        DB::table('spell_list_dps')->insert([
            'spell_user_type' => $row['spell_user_type'],
            'own_realm' => json_encode($row['own_realm']),
            'other_realm' => json_encode($row['other_realm']),
            'is_editable' => 0
        ]);
    }

    private function fill_dp($spell_realm_type){
        $data = [];

        foreach ($spell_realm_type as $index => $value) {
            $data[$index] = [];

            for ($i = 1; $i <= 5; $i++) {
                $j = ($i < 5 ? $i * 5 : 21);

                if (is_numeric($value)) {
                    $data[$index][$j] = $value * $i;
                } else {
                    $data[$index][$j] = $value;
                }
            }
        }

        return $data;
    }
}
