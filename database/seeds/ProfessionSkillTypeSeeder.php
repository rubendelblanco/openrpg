<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfessionSkillTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('professions_skills_types')->truncate();
        $json_professions = json_decode(file_get_contents('database/seeds/fixtures/professions.json'));
        $professions_with_selectable_skills = ['ladron','monje-guerrero','barbaro','sanador','alquimista-de-mentalismo',
            'alquimista-de-canalizacion','alquimista-de-esencia','luchador'];

        foreach ($json_professions as $profession => $data) {
            $skill_types = [
                'everyman' => $data->common_skills,
                'occupational' => $data->professional_skills,
                'restricted' => $data->restricted_skills
            ];

            if ( !in_array($profession, $professions_with_selectable_skills)) {
                foreach ( $skill_types as $type_key => $type){

                    (count ($type) >0 ) ? $array_of_skills = explode(',',$type[0]): $array_of_skills = [];

                    foreach ($array_of_skills as $skill) {
                        try {
                            DB::table('professions_skills_types')->insert([
                                'profession_id' => $profession,
                                'skill_id' => Str::slug(trim($skill), '_'),
                                'skill_type' => $type_key
                            ]);
                        }
                        catch (Exception $e) {
                            //just go on!
                        }
                    }
                }
            }
            else {
                foreach ( $skill_types as $key=>$type){
                    if ( property_exists($type, 'not_selectables' )){
                        try {
                            $this->insertNotSelectablesSkills($type->not_selectables, $profession, $key);
                        }
                        catch (Exception $e){
                            //just go on!!
                        }
                    }
                }
            }
        }
        $this->insertSelectablesSkills();
    }

    private function insertNotSelectablesSkills($not_selectables, $profession, $type):void {
        foreach ( $not_selectables as $skill) {
            DB::table('professions_skills_types')->insert([
                'profession_id' => $profession,
                'skill_id' => Str::slug(trim($skill),'_'),
                'skill_type' => $type
            ]);
        }
    }

    private function insertSelectablesSkills():void {
        $everyman_skills = [ 'ladron' => [
                "Percepcion del Entorno: Ciudades",
                "Percepcion del Entorno: Combate",
                "Percepcion del Entorno: Durmiendo",
                "Percepcion del Entorno: Exploracion"
                ],
            'barbaro' => [
                "Supervivencia",
                "Supervivencia (Montanas)",
                "Supervivencia (Bosques)",
                "Supervivencia (Desiertos)",
                "Supervivencia (Llanuras)"
            ],
            'sanador' => [
                "Cirugia",
                "Cuidados Medicos",
                "Parteria"
            ]
        ];

        $occupational_skills = [
            'sanador' => [
                "Curacion de Animales",
                "Primeros Auxilios"
            ]
        ];

        foreach ($everyman_skills as $profession => $skills) {
            foreach ( $skills as $skill) {
                DB::table('professions_skills_types')->insert([
                    'profession_id' => $profession,
                    'skill_id' => Str::slug(trim($skill), '_'),
                    'skill_type' => 'everyman',
                    'skill_set' => 1
                ]);
            }
        }

        foreach ($occupational_skills as $profession => $skills) {
            foreach ( $skills as $skill) {
                try {
                    DB::table('professions_skills_types')->insert([
                        'profession_id' => $profession,
                        'skill_id' => Str::slug(trim($skill), '_'),
                        'skill_type' => 'occupational',
                        'skill_set' => 1
                    ]);
                }
                catch (Exception $e){

                }
            }
        }
    }

}
