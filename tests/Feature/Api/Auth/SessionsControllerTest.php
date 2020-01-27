<?php

namespace Tests\Feature;

use Tests\TestCase;

class SessionsControllerTest extends TestCase
{
    public function testEndpointFailsIfMissingParameters()
    {
        $headers = ['Accept' => 'application/json'];
        $response = $this->post('/api/auth/sessions', [], $headers);
        $response->assertStatus(401);
        $response->assertJsonStructure(['error']);
    }

    public function testEndpointSucceedsIfGivenParameters()
    {
        $headers = ['Accept' => 'application/json'];
        $response = $this->post('/api/auth/sessions', [
            'email' => 'admin@test.com',
            'password' => 'admin',
        ], $headers);
        $response->assertStatus(200);
        $response->assertJsonStructure(['token']);
    }
}
