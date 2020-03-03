<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class SpellListsControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    public function testUpdateSpellListNameIsAutomaticallyUpdatesSpellListName()
    {
        // Create the spell list
        $payload = [
            'name' => 'Vias de la contencion',
            'description' => 'Debufa y paraliza a entes magicos',
            'notes' => '- none -',
            'list_type' => 'open'
        ];
        $response = $this->actingAs($this->user, 'jwt')
            ->json('POST', '/api/spell-lists/', $payload)
            ->assertStatus(201);
        $spellList = $response->decodeResponseJson()['data'];
        // Create the spell associating the spell list
        $payload = [
            'name' => 'impedir miembro',
            'level' => 3,
            'description' => 'Paraliza un miembro del enemigo (debe haber contacto)',
            'list_name' => $spellList['name'],
            'code' => 'std',
            'class' => 'F',
            'subclass' => 'none',
            'effect_area' => '{"code": "TARGET"}',
            'duration' => '{"code": "TIME_LVL", "data": 3}',
            'range' => '{"code": "CON"}',
            'notes' => '- none -',
            'list_id' => $spellList['id']
        ];
        $response = $this->actingAs($this->user, 'jwt')
            ->json('POST', '/api/spells/', $payload)
            ->assertStatus(201);
        $spell = $response->decodeResponseJson()['data'];
        $this->assertEquals($spellList['id'], $spell['list_id']);
        $this->assertEquals($spellList['name'], $spell['list_name']);
        $this->assertEquals($spell['name'], 'impedir miembro');
        // Update Spell list name
        $uri = ('/api/spell-lists/' . $spellList['id'] . '/');
        # Manually testing this works. An issue with PATCH requests maybe?
        $response = $this->actingAs($this->user, 'jwt')
            ->json('PATCH', $uri, [
                'name' => 'Ley de la contencion'
            ])
            ->assertStatus(200);
        $spellListPatch = $response->decodeResponseJson();
        $this->assertEquals($spellListPatch['data']['name'], 'Ley de la contencion');
        // Spell list name should have been updated
        $spell = $this->actingAs($this->user, 'jwt')
            ->json('GET', '/api/spells/' . $spell['id'])
            ->assertStatus(200)
            ->decodeResponseJson();
        $this->assertEquals($spell['list_name'], 'Ley de la contencion');
    }

    public function testSpellandListCreation()
    {
        // Create the spell list
        $payload = [
            'name' => 'Vias de la contencion',
            'description' => 'Debufa y paraliza a entes magicos',
            'notes' => '- none -',
            'list_type' => 'open'
        ];
        $response = $this->actingAs($this->user, 'jwt')
            ->json('POST', '/api/spell-lists/', $payload)
            ->assertStatus(201);
        // $response->dump();
        $spellList = $response->decodeResponseJson()['data'];
        $payload = [
            'name' => 'impedir miembro',
            'level' => 3,
            'description' => 'Paraliza un miembro del enemigo (debe haber contacto)',
            'list_name' => $spellList['name'],
            'code' => 'std',
            'class' => 'F',
            'subclass' => 'none',
            'effect_area' => '{"code": "TARGET"}',
            'duration' => '{"code": "TIME_LVL", "data": 3}',
            'range' => '{"code": "CON"}',
            'notes' => '- none -',
            'list_id' => $spellList['id']
        ];
        $response = $this->actingAs($this->user, 'jwt')
            ->json('POST', '/api/spells/', $payload)
            ->assertStatus(201);
        $spell = $response->decodeResponseJson()['data'];

        $this->assertEquals($spellList['id'], $spell['list_id']);
        $this->assertEquals($spellList['name'], $spell['list_name']);
        $this->assertEquals($spell['name'], 'impedir miembro');
    }

    public function testEndpointDeleteReturnsNotFoundIfSpellListDoesNotExist()
    {
        $this->actingAs($this->user, 'jwt')
            ->json('DELETE', 'api/spell-lists/43', [])
            ->assertStatus(404);
    }

    public function testEndpointDeleteReturnsNoContentIfSpellIsSuccessfullyDeleted()
    {
        // Create the spell list
        $payload = [
            'name' => 'Arcane shields',
            'description' => 'Arcane shields groups defensive spells against either physhical or magical attacks',
            'notes' => '- none -',
            'list_type' => 'open'
        ];
        // $response->dump();
        $body = $this->actingAs($this->user, 'jwt')
            ->json('POST', '/api/spell-lists/', $payload)
            ->assertStatus(201)
            ->decodeResponseJson();
        $this->actingAs($this->user, 'jwt')
            ->json('DELETE', '/api/spell-lists/' . $body['data']['id'], [])
            ->assertStatus(204);
    }

    public function testEndpointRequiresTitle()
    {
        $payload = [
            // 'name' => 'Arcane shields',
            'description' => 'Arcane shields groups defensive spells against either physhical or magical attacks',
            'notes' => '- none -',
            'list_type' => 'open'
        ];
        $this->actingAs($this->user, 'jwt')
            ->json('POST', 'api/spell-lists/', $payload)
            ->assertStatus(422);
    }

    public function testEndpointRequiresListType()
    {
        $payload = [
            'name' => 'Arcane shields',
            'description' => 'Arcane shields groups defensive spells against either physhical or magical attacks',
            'notes' => '- none -',
            // 'list_type' => 'open'
        ];
        $this->actingAs($this->user, 'jwt')->json('POST', '/api/spell-lists/', $payload)->assertStatus(422);
    }

    public function testEndpointFailsIfWrongListType()
    {
        $payload = [
            'name' => 'Arcane shields',
            'description' => 'Arcane shields groups defensive spells against either physhical or magical attacks',
            'notes' => '- none -',
            'list_type' => 'whatever' // check config.rolemaster.spell_list_types
        ];
        $this->actingAs($this->user, 'jwt')
            ->json('POST', '/api/spell-lists/', $payload)
            ->assertStatus(422)
            ->assertJson([
                'error' => 'unknown list type'
            ]);
    }

    public function testEndpointNotesCanBeNone()
    {
        $payload = [
            'name' => 'Arcane shields',
            'description' => 'Arcane shields groups defensive spells against either physhical or magical attacks',
            'notes' => null,
            'list_type' => 'whatever' // check config.rolemaster.spell_list_types
        ];
        $response = $this->actingAs($this->user, 'jwt')->json('POST', 'api/spell-lists/', $payload)->assertStatus(422);
    }

    public function testEndpointOK()
    {
        $payload = [
            'name' => 'Arcane shields',
            'description' => 'Arcane shields groups defensive spells against either physhical or magical attacks',
            'notes' => '- none -',
            'list_type' => 'open'
        ];
        $response = $this->actingAs($this->user, 'jwt')->json('POST', '/api/spell-lists/', $payload)->assertStatus(201);
    }
}
