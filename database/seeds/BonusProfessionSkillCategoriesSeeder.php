<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BonusProfessionSkillCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json_professions = json_decode(file_get_contents('database/seeds/fixtures/professions.json'));

        foreach ($json_professions as $profession => $data) {
            $profession_id = Str::slug(trim($profession),'_');
            $profession_exists = DB::table('professions')->where('code', '=', $profession_id)->exists();

            if ($profession_exists) {

                foreach ($data->skill_category_ranges as $dp) {
                    $query = DB::table('skill_categories')->whereRaw('name like \'%' . $dp->skill_cat . '%\'')->first();
                    $bonus = 0;

                    foreach ($data->profession_bonus as $b) {
                        if ($b->prof === $query->name) {
                            $bonus = $b->bonus;
                        }
                    }

                    $row = [
                        'skill_category_id' => $query->code,
                        'bonus' => $bonus,
                        'profession_id' => $profession_id,
                        'dp' => $dp->ranges
                    ];
                    DB::table('bonus_profession_skill_category')->insert($row);
                }
            }
        }
    }
}
