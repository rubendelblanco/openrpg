<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SpellListsControllerTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    public function testEndpointDeleteReturnsNotFoundIfSpellListDoesNotExist()
    {
        $response = $this->json('DELETE', 'api/spell-lists/43', []);
        $response->assertStatus(404);
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
        $response = $this->json('POST', '/api/spell-lists/', $payload);
        $response->assertStatus(201);
        // $response->dump();
        $body = $response->decodeResponseJson();
        $response = $this->json('DELETE', 'api/spell-lists/' . $body['data']['id'], []);
        $response->assertStatus(204);
    }

    public function testEndpointRequiresTitle()
    {
        $payload = [
            // 'name' => 'Arcane shields',
            'description' => 'Arcane shields groups defensive spells against either physhical or magical attacks',
            'notes' => '- none -',
            'list_type' => 'open'
        ];
        $response = $this->json('POST', 'api/spell-lists/', $payload);
        $response->assertStatus(422);
    }

    public function testEndpointRequiresListType()
    {
        $payload = [
            'name' => 'Arcane shields',
            'description' => 'Arcane shields groups defensive spells against either physhical or magical attacks',
            'notes' => '- none -',
            // 'list_type' => 'open'
        ];
        $response = $this->json('POST', '/api/spell-lists/', $payload, );
        $response->assertStatus(422);
    }

    public function testEndpointFailsIfWrongListType() {
        $payload = [
            'name' => 'Arcane shields',
            'description' => 'Arcane shields groups defensive spells against either physhical or magical attacks',
            'notes' => '- none -',
            'list_type' => 'whatever' // check config.rolemaster.spell_list_types
        ];
        $response = $this->json('POST', '/api/spell-lists/', $payload);
        $response->assertStatus(422);
    }

    public function testEndpointNotesCanBeNone() {
        $payload = [
            'name' => 'Arcane shields',
            'description' => 'Arcane shields groups defensive spells against either physhical or magical attacks',
            'notes' => null,
            'list_type' => 'whatever' // check config.rolemaster.spell_list_types
        ];
        $response = $this->json('POST', 'api/spell-lists/', $payload);
        $response->assertStatus(422);
    }

    public function testEndpointOK() {
        $payload = [
            'name' => 'Arcane shields',
            'description' => 'Arcane shields groups defensive spells against either physhical or magical attacks',
            'notes' => '- none -',
            'list_type' => 'open'
        ];
        $response = $this->json('POST', '/api/spell-lists/', $payload);
        $response->assertStatus(201);
    }
}
