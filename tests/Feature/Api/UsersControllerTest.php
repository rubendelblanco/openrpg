<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $user1;

    private $user2;

    protected function setUp(): void
    {
        parent::setUp();

        // Wipe seeded users to prevent ID conflicts in tests.
        // To prevent data loss, this runs inside a transaction.
        User::truncate();

        $this->user1 = factory(User::class)->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => '00000000',
        ]);
        $this->user2 = factory(User::class)->create([
            'name' => 'Foo Bar',
            'email' => 'foobar@example.com',
        ]);
    }

    public function testIndexSucceeds()
    {
        $this->actingAs($this->user1, 'jwt')
             ->json('get', '/api/users')
             ->assertStatus(200)
             ->assertJson([
                 'data' => [
                     [
                         'id' => $this->user1->id,
                         'name' => 'John Doe',
                         'email' => 'johndoe@example.com',
                     ],
                     [
                         'id' => $this->user2->id,
                         'name' => 'Foo Bar',
                         'email' => 'foobar@example.com',
                     ],
                 ],
             ]);
    }

    public function testIndexFailsIfUnauthenticated()
    {
        $this->json('get', '/api/users')
             ->assertStatus(401);
    }

    public function testStoreSucceeds()
    {
        $payload = [
            'name' => 'John Smith',
            'email' => 'johnsmith@example.com',
            'password' => '12345678',
            'repeat_password' => '12345678',
        ];
        $this->actingAs($this->user1, 'jwt')
             ->json('post', '/api/users/', $payload)
             ->assertStatus(201)
             ->assertHeader('Location');
        $this->assertDatabaseHas('users', [
            'name' => 'John Smith',
            'email' => 'johnsmith@example.com',
        ]);
        $this->json('post', '/api/auth/sessions', [
            'email' => 'johnsmith@example.com',
            'password' => '12345678'
        ])
             ->assertStatus(200);
    }

    public function testStoreFailsIfEmailTaken()
    {
        $payload = [
            'name' => 'John Smith',
            'email' => 'foobar@example.com',
            'password' => '12345678',
            'repeat_password' => '12345678',
        ];
        $this->actingAs($this->user1, 'jwt')
             ->json('post', '/api/users/', $payload)
             ->assertStatus(422);
    }

    public function testStoreFailsIfInvalid()
    {
        $payload = [
            'name' => 'John Smith',
            'email' => 'johnsmith@example.com',
            'password' => '12345678',
            'repeat_password' => '87654321',
        ];
        $this->actingAs($this->user1, 'jwt')
             ->json('post', '/api/users/', $payload)
             ->assertStatus(422);

        $this->json('post', '/api/auth/sessions', [
            'email' => 'johnsmith@example.com',
            'password' => '12345678'
        ])
             ->assertStatus(401);
    }

    public function testStoreFailsIfUnauthenticated()
    {
        $payload = [
            'name' => 'John Smith',
            'email' => 'johnsmith@example.com',
            'password' => '12345678',
            'repeat_password' => '12345678',
        ];
        $this->json('post', '/api/users/', $payload)
             ->assertStatus(401);
    }

    public function testStoreIntegration()
    {
        $payload = [
            'name' => 'John Smith',
            'email' => 'johnsmith@example.com',
            'password' => '12345678',
            'repeat_password' => '12345678',
        ];
        $response = $this->actingAs($this->user1, 'jwt')
                         ->json('post', '/api/users/', $payload);
        $this->actingAs($this->user1, 'jwt')
             ->json('get', $response->headers->get('Location'))
             ->assertStatus(200)
             ->assertJson([
                 'data' => [
                     'name' => 'John Smith',
                     'email' => 'johnsmith@example.com',
                 ],
             ]);
    }

    public function testShowSucceeds()
    {
        $this->actingAs($this->user1, 'jwt')
             ->json('get', "/api/users/{$this->user1->id}")
             ->assertStatus(200)
             ->assertJson([
                 'data' => [
                     'id' => $this->user1->id,
                     'name' => 'John Doe',
                     'email' => 'johndoe@example.com',
                 ],
             ]);
    }

    public function testShowFailsIfNotExist()
    {
        $this->user1->delete();
        $this->actingAs($this->user1, 'jwt')
             ->json('get', "/api/users/{$this->user1->id}")
             ->assertStatus(404);
    }

    public function testShowFailsIfUnauthenticated()
    {
        $this->json('get', "/api/users/{$this->user1->id}")
             ->assertStatus(401);
    }

    public function testUpdateSucceeds()
    {
        $payload = [
            'name' => 'Jack Daniels',
            'email' => 'jackdaniels@example.com',
        ];
        $this->actingAs($this->user1, 'jwt')
             ->json('put', "/api/users/{$this->user1->id}", $payload)
             ->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'id' => $this->user1->id,
            'name' => 'Jack Daniels',
            'email' => 'jackdaniels@example.com',
        ]);
        $this->json('post', '/api/auth/sessions', [
            'email' => 'jackdaniels@example.com',
            'password' => '00000000'
        ])
             ->assertStatus(200);
    }

    public function testUpdateFailsIfEmailTaken()
    {
        $payload = [
            'name' => 'Jack Daniels',
            'email' => 'foobar@example.com',
        ];
        $this->actingAs($this->user1, 'jwt')
             ->json('put', "/api/users/{$this->user1->id}", $payload)
             ->assertStatus(422);
    }

    public function testUpdateSucceedsIfDoesntChangeEmail()
    {
        $payload = [
            'name' => 'Jack Bauer',
            'email' => 'johndoe@example.com',
        ];
        $this->actingAs($this->user1, 'jwt')
             ->json('put', "/api/users/{$this->user1->id}", $payload)
             ->assertStatus(200);
    }

    public function testUpdatePartiallySucceeds()
    {
        $payload = [
            'name' => 'Jack Daniels',
        ];
        $this->actingAs($this->user1, 'jwt')
             ->json('patch', "/api/users/{$this->user1->id}", $payload)
             ->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'id' => $this->user1->id,
            'name' => 'Jack Daniels',
            'email' => 'johndoe@example.com',
        ]);
        $this->json('post', '/api/auth/sessions', [
            'email' => 'johndoe@example.com',
            'password' => '00000000'
        ])
             ->assertStatus(200);
    }

    public function testUpdateWithPasswordSucceeds()
    {
        $payload = [
            'name' => 'Jack Daniels',
            'email' => 'jackdaniels@example.com',
            'password' => '20202020',
            'repeat_password' => '20202020',
        ];
        $this->actingAs($this->user1, 'jwt')
             ->json('put', "/api/users/{$this->user1->id}", $payload)
             ->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'id' => $this->user1->id,
            'name' => 'Jack Daniels',
            'email' => 'jackdaniels@example.com',
        ]);
        $this->json('post', '/api/auth/sessions', [
            'email' => 'jackdaniels@example.com',
            'password' => '20202020'
        ])
             ->assertStatus(200);
    }

    public function testUpdateFailsIfNotValid()
    {
        $payload = [
            'name' => '',
        ];
        $this->actingAs($this->user1, 'jwt')
             ->json('patch', "/api/users/{$this->user1->id}", $payload)
             ->assertStatus(422);
    }

    public function testUpdateFailsIfNotAuthenticated()
    {
        $payload = [
            'name' => 'Jack Daniels',
        ];
        $this->json('patch', "/api/users/{$this->user1->id}", $payload)
             ->assertStatus(401);
    }

    public function testUpdateIntegration()
    {
        $payload = [
            'name' => 'Jack Daniels',
        ];
        $this->actingAs($this->user1, 'jwt')
             ->json('patch', "/api/users/{$this->user1->id}", $payload)
             ->assertStatus(200);
        $this->actingAs($this->user1, 'jwt')
             ->json('get', "/api/users/{$this->user1->id}")
             ->assertStatus(200)
             ->assertJson([
                 'data' => [
                     'id' => $this->user1->id,
                     'name' => 'Jack Daniels',
                     'email' => 'johndoe@example.com',
                 ],
             ]);
    }

    public function testDestroySucceeds()
    {
        $this->actingAs($this->user2, 'jwt')
             ->json('delete', "/api/users/{$this->user1->id}")
             ->assertStatus(200);
        $this->assertDeleted($this->user1);
    }

    public function testDestroyFailsIfUnauthenticated()
    {
        $this->json('delete', "/api/users/{$this->user1->id}")
             ->assertStatus(401);
    }

    public function testDestroyFailsIfDestroysItself()
    {
        $this->actingAs($this->user1, 'jwt')
             ->json('delete', "/api/users/{$this->user1->id}")
             ->assertStatus(403);
    }

    public function testDestroyIntegration()
    {
        $this->actingAs($this->user2, 'jwt')
             ->json('delete', "/api/users/{$this->user1->id}")
             ->assertStatus(200);
        $this->actingAs($this->user2, 'jwt')
             ->json('get', "/api/users/{$this->user1->id}")
             ->assertStatus(404);
    }
}
