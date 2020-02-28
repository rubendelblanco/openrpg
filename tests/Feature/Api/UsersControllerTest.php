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
}
