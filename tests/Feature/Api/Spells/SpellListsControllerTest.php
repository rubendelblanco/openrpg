<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SpellListsControllerTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    public function testEndpointRequiresTitle()
    {
        $payload = [
            // 'title' => 'Arcane shields',
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
            'title' => 'Arcane shields',
            'description' => 'Arcane shields groups defensive spells against either physhical or magical attacks',
            'notes' => '- none -',
            // 'list_type' => 'open'
        ];
        $response = $this->json('POST', '/api/spell-lists/', $payload, );
        $response->assertStatus(422);
    }

    public function testEndpointFailsIfWrongListType() {
        $payload = [
            'title' => 'Arcane shields',
            'description' => 'Arcane shields groups defensive spells against either physhical or magical attacks',
            'notes' => '- none -',
            'list_type' => 'whatever' // check config.rolemaster.spell_list_types
        ];
        $response = $this->json('POST', '/api/spell-lists/', $payload);
        $response->assertStatus(422);
    }

    public function testEndpointNotesCanBeNone() {
        $payload = [
            'title' => 'Arcane shields',
            'description' => 'Arcane shields groups defensive spells against either physhical or magical attacks',
            'notes' => null,
            'list_type' => 'whatever' // check config.rolemaster.spell_list_types
        ];
        $response = $this->json('POST', 'api/spell-lists/', $payload);
        $response->assertStatus(422);
    }

    public function testEndpointOK() {
        $payload = [
            'title' => 'Arcane shields',
            'description' => 'Arcane shields groups defensive spells against either physhical or magical attacks',
            'notes' => '- none -',
            'list_type' => 'open'
        ];
        $response = $this->json('POST', '/api/spell-lists/', $payload);
        $response->assertStatus(422);
    }

    protected function prepareAjaxJsonRequest()
    {
    }
}
