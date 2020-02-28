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
}
