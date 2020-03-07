<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Character;
use App\User;
use Tests\TestCase;

class CharactersControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $user;

    private $character1;

    private $character2;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->character1 = factory(Character::class)->create([
            'name' => 'John Doe',
            'experience' => 50000,
            'level' => 5,
            'user_id' => $this->user->id,
        ]);
        $this->character2 = factory(Character::class)->create([
            'name' => 'Foo Bar',
            'experience' => 55000,
            'level' => 5,
            'user_id' => $this->user->id,
        ]);
    }

    public function testIndexSucceeds()
    {
        $this->actingAs($this->user, 'jwt')
             ->json('get', '/api/characters')
             ->assertStatus(200)
             ->assertJson([
                 'data' => [
                     [
                         'id' => $this->character1->id,
                         'name' => 'John Doe',
                         'level' => 5,
                         'experience' => 50000,
                     ],
                     [
                         'id' => $this->character2->id,
                         'name' => 'Foo Bar',
                         'level' => 5,
                         'experience' => 55000,
                     ],
                 ]
             ]);
    }

    public function testIndexFailsIfUnauthenticated()
    {
        $this->json('get', '/api/characters')
             ->assertStatus(401);
    }

    public function testStoreSucceeds()
    {
        $payload = [
            'name' => 'John Smith',
            'experience' => 50000,
        ];
        $this->actingAs($this->user, 'jwt')
             ->json('post', '/api/characters', $payload)
             ->assertStatus(201)
             ->assertHeader('Location');
        $this->assertDatabaseHas('characters', [
            'name' => 'John Smith',
            'experience' => 50000,
            'level' => 5,
            'user_id' => $this->user->id,
        ]);
    }

    public function testStoreFailsIfInvalid()
    {
        $payload = [
            'name' => '',
            'experience' => 50000,
        ];
        $this->actingAs($this->user, 'jwt')
             ->json('post', '/api/characters')
             ->assertStatus(422);
    }

    public function testStoreFailsIfUnauthenticated()
    {
        $payload = [
            'name' => 'John Smith',
            'experience' => 50000,
        ];
        $this->json('post', '/api/characters')
             ->assertStatus(401);
    }

    public function testStoreIntegration()
    {
        $payload = [
            'name' => 'John Smith',
            'experience' => 50000,
        ];
        $response = $this->actingAs($this->user, 'jwt')
                         ->json('post', '/api/characters', $payload);
        $this->actingAs($this->user, 'jwt')
             ->json('get', $response->headers->get('Location'))
             ->assertStatus(200)
             ->assertJson([
                 'data' => [
                     'name' => 'John Smith',
                     'level' => 5,
                     'experience' => 50000,
                 ]
             ]);
    }

    public function testShowSucceeds()
    {
        $this->actingAs($this->user, 'jwt')
             ->json('get', "/api/characters/{$this->character1->id}")
             ->assertStatus(200)
             ->assertJson([
                 'data' => [
                     'id' => $this->character1->id,
                     'name' => 'John Doe',
                     'level' => 5,
                     'experience' => 50000,
                 ]
             ]);
    }

    public function testShowFailsIfUnauthenticated()
    {
        $this->json('get', "/api/characters/{$this->character1->id}")
             ->assertStatus(401);
    }

    public function testShowFailsIfDoesNotExist()
    {
        $this->character1->delete();
        $this->actingAs($this->user, 'jwt')
             ->json('get', "/api/characters/{$this->character1->id}")
             ->assertStatus(404);
    }

    public function testUpdateSucceeds()
    {
        $payload = [
            'name' => 'Foo Bar',
            'experience' => 70000,
        ];
        $this->actingAs($this->user, 'jwt')
             ->json('put', "/api/characters/{$this->character1->id}", $payload)
             ->assertStatus(200);
        $this->assertDatabaseHas('characters', [
            'id' => $this->character1->id,
            'name' => 'Foo Bar',
            'experience' => 70000,
            'level' => 6,
        ]);
    }

    public function testUpdatePartiallySucceeds()
    {
        $payload = [
            'name' => 'Foo Bar',
        ];
        $this->actingAs($this->user, 'jwt')
             ->json('patch', "/api/characters/{$this->character1->id}", $payload)
             ->assertStatus(200);
        $this->assertDatabaseHas('characters', [
            'id' => $this->character1->id,
            'name' => 'Foo Bar',
            'experience' => 50000,
            'level' => 5,
        ]);
    }

    public function testUpdateFailsIfNotValid()
    {
        $payload = [
            'name' => ''
        ];
        $this->actingAs($this->user, 'jwt')
             ->json('patch', "/api/characters/{$this->character1->id}", $payload)
             ->assertStatus(422);
    }

    public function testUpdateFailsIfNotAuthenticated()
    {
        $payload = [
            'name' => 'Foo Bar'
        ];
        $this->json('patch', "/api/characters/{$this->character1->id}", $payload)
             ->assertStatus(401);
    }

    public function testUpdateIntegration()
    {
        $payload = [
            'name' => 'Foo Bar',
        ];
        $this->actingAs($this->user, 'jwt')
             ->json('patch', "/api/characters/{$this->character1->id}", $payload)
             ->assertStatus(200);
        $this->actingAs($this->user, 'jwt')
             ->json('get', "/api/characters/{$this->character1->id}")
             ->assertStatus(200)
             ->assertJson([
                 'data' => [
                     'id' => $this->character1->id,
                     'name' => 'Foo Bar',
                     'experience' => 50000,
                     'level' => 5,
                 ],
             ]);
    }

    public function testDestroySucceeds()
    {
        $this->actingAs($this->user, 'jwt')
             ->json('delete', "/api/characters/{$this->character1->id}")
             ->assertStatus(200);
        $this->assertDeleted($this->character1);
    }

    public function testDestroyFailsIfUnauthenticated()
    {
        $this->json('delete', "/api/characters/{$this->character1->id}")
             ->assertStatus(401);
    }

    public function testDestroyIntegration()
    {
        $this->actingAs($this->user, 'jwt')
             ->json('delete', "/api/characters/{$this->character1->id}")
             ->assertStatus(200);
        $this->actingAs($this->user, 'jwt')
             ->json('get', "/api/characters/{$this->character1->id}")
             ->assertStatus(404);
    }
}
