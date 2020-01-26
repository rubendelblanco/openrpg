<?php

namespace Tests\Feature;

use Tests\TestCase;
use JWTAuth;

class SessionControllerTest extends TestCase
{
    public function testShowFailsIfAnonymous()
    {
        $headers = ['Accept' => 'application/json'];
        $this->get('/api/auth/session', $headers)->assertStatus(401);
    }

    public function testShowProvidesInfo()
    {
        $token = $this->authenticate();

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ];
        $response = $this->get('/api/auth/session', $headers);
        $response->assertStatus(200);
        $response->assertJsonStructure(['user']);
    }

    public function testDestroyInvalidatesToken()
    {
        $token = $this->authenticate();

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ];
        $this->get('/api/auth/session', $headers)->assertStatus(200);
        $this->delete('/api/auth/session', [], $headers)->assertStatus(204);
        $this->get('/api/auth/session', $headers)->assertStatus(401);
    }

    private function authenticate()
    {
        $login = ['email' => 'admin@test.com', 'password' => 'admin'];
        $token = JWTAuth::attempt($login);
        $this->assertNotNull($token);
        return $token;
    }
}
