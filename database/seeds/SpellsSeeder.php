<?php

use Illuminate\Database\Seeder;

class SpellsSeeder extends Seeder
{
  /**
   * Run the database seeds.

                                                                              
       6. Toughness I — For the duration of this spell, any wounds that       
         deliver stun effects to the caster have the number of rounds of 

         stun reduced by one.                                                 

       7. Focus I —Caster receives a special +15 bonus to his next static     

         maneuver (the static maneuver must be completed before the           
         duration of this spell expires).                                     

       8. Strength II — In melee, the caster does double normal               

         concussion hits and his Strength stat bonus is doubled.
                                                                              
       9. Haste II — As Haste I, except for the duration.
                                                                              
       10. Initiative X — Caster adcls I0 to his next initiative roll next    
         round.                                                               
       11. Focus II — As I: ()CUE 1, except the bonus is +30.                 

       12. Toughness II — For the duration of this spell, all criticals 
         against the caster are reduced by one in severity                    
         becomes a "D", "B" becomes an "A", with an "A" receiving a           

         -50 modification).
       13. Haste III — As Haste I, except for the duration.                   
                                                                              
       14. Focus III         As Focus I, except the bonus is +45.             

       15. Health —Fur the duration of this spell, the caster receives a      
         bonus of +50 to any RRs versus disease and poison.                   

       17. Haste IV — As Haste 1, except for the duration.                    

       20. Unpain IV — Caster is able to sustain and additional 100% 
         of his total concussion hits before passing out. Hits are still 
         taken and remain when the spell lapses.

       25. Toughness III — For the duration of this spell, the caster's 
         skin toughens, giving him an effective AT of 11.

       30. Focus True — As Focus I, except the bonus is +60.

       50. Toughness True — Caster receives the 

         bonuses of Toughness1,Toughness11,Tough- 

         ness 111, and Unpuin simultaneously.


   * @return void
   */

  public function run()
  {
    $spell_list_types = config('rolemaster.spell_list_type');
    $spell_codes = config('rolemaster.spells.codes');
    $spell_classes = config('rolemaster.spells.classes');
    $spell_subclasses = config('rolemaster.spells.subclasses');
    $spell_effects = config('rolemaster.spells.effect_areas');
    $spell_duration = config('rolemaster.spells.duration');
    $spell_range = config('rolemaster.spells.range');

    $lists = [
      [
        "name" => "Amplificaciones",
        "description" => "Los hechizos de esta lista sirven para bufar",
        "list_type" => $spell_list_types["basic"]['code'],
        "notes" => "",
        "spells" => [
          [
            "level" => 1,
            "name" => "Memorizar",
            "description" => "El lanzador memoriza una unica imagen que puede ser recordada en cualquier momento. Solo se puede memorizar una imagen por nivel del hechicero.",
            "notes" => "",
            "list_name" => "Amplificaciones",
            "code" => $spell_codes["std"]["code"],
            "class" => $spell_classes['U']['code'],
            "subclass" => $spell_subclasses['none']['code'],
            "effect_area" => json_encode(['code' => $spell_effects["SELF"]['code']]),
            "duration" => json_encode(['code' => $spell_duration["INS"]["code"]]),
            "range" => json_encode(['code' => $spell_range["SELF"]["code"]]),
          ],
          [
            "level" => 3,
            "name" => "Iniciativa V",
            "description" => "El lanzador aumenta +5 a su tirada de iniciativa en el siguiente asalto",
            "notes" => "",
            "list_name" => "Amplificaciones",
            "code" => $spell_codes["ins"]["code"],
            "class" => $spell_classes['U']['code'],
            "subclass" => $spell_subclasses['none']['code'],
            "effect_area" => json_encode(['code' => $spell_effects["SELF"]['code']]),
            "duration" => json_encode([
              'code' => $spell_duration["TIME"]["code"],
              'unit' => 'rnd',
              'amount' => 1,
            ]),
            "range" => json_encode(['code' => $spell_range["SELF"]["code"]]),
          ],
          [
            "level" => 4,
            "name" => "Lectura rapida II",
            "description" => "El lanzador puede leer a un ritmo de 20 paginas por minuto",
            "notes" => "",
            "list_name" => "Amplificaciones",
            "code" => $spell_codes["std"]["code"],
            "class" => $spell_classes['U']['code'],
            "subclass" => $spell_subclasses['none']['code'],
            "effect_area" => json_encode(['code' => $spell_effects["SELF"]['code']]),
            "duration" => json_encode([
              'code' => $spell_duration["TIME_LVL"]["code"],
              'amount' => 10,
              'unit' => 'min'
            ]),
            "range" => json_encode(['code' => $spell_range["SELF"]["code"]]),
          ],
          [
            "level" => 5,
            "name" => "Mas rapido I",
            "description" => "El objetivo puede actuar al doble de su ritmo",
            "notes" => "Ver seccion 7.1.24 de la Guia de los Hechizos para mas informacion",
            "list_name" => "Amplificaciones",
            "code" => $spell_codes["ins"]["code"],
            "class" => $spell_classes['U']['code'],
            "subclass" => $spell_subclasses['none']['code'],
            "effect_area" => json_encode(['code' => $spell_effects["SELF"]['code']]),
            "duration" => json_encode([
              'code' => $spell_duration["TIME"]["code"],
              'amount' => 1,
              'unit' => 'rnd'
            ]),
            "range" => json_encode(['code' => $spell_range["SELF"]["code"]]),
          ]
        ]
      ]
    ];

    foreach ($lists as $list) {
      $spells = $list['spells'];
      unset($list['spells']);
      $list_id = DB::table('spell_lists')->insertGetId($list);
      foreach ($spells as $spell) {
        $spell['list_id'] = $list_id;
        DB::table('spells')->insert($spell);
      }
    }
  }
}
