<?php

namespace Tests\Feature;

use Tests\TestCase;
use JWTAuth;

class RefreshmentsControllerTest extends TestCase
{
    public function testEndpointFailsIfAnonymous()
    {
        $headers = ['Accept' => 'application/json'];
        $response = $this->post('/api/auth/refreshments', [], $headers);
        $response->assertStatus(401);
    }

    public function testEndpointRefreshesToken()
    {
        $token = $this->authenticate();

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ];
        $response = $this->post('/api/auth/refreshments', [], $headers);
        $response->assertStatus(200);
        $response->assertJsonStructure(['token']);

        // New token is different than old one.
        $new_token = $response->getOriginalContent()['token'];
        $this->assertNotEquals($token, $new_token);

        // New token is valid.
        $headers['Authorization'] = 'Bearer ' . $new_token;
        $this->get('/api/auth/session', $headers)->assertStatus(200);
    }

    private function authenticate()
    {
        $login = ['email' => 'admin@test.com', 'password' => 'admin'];
        $token = JWTAuth::attempt($login);
        $this->assertNotNull($token);
        return $token;
    }
}
