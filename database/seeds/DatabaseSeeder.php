<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserSeeder::class);
         $this->call(SkillCategorySeeder::class);
         $this->call(SkillSeeder::class);
         $this->call(SpellListDP::class);
    }
}
