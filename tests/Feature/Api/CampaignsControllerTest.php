<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Campaign;

class CampaignsControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $gamemaster;

    protected $campaign1;

    protected $campaign2;

    protected function setUp(): void
    {
        parent::setUp();
        $this->gamemaster = factory(User::class)->create();
        $this->campaign1 = factory(Campaign::class)->create([
            'title' => 'The Lord of the Rings',
            'description' => 'The original, except we slaughtered the book',
            'gamemaster_id' => $this->gamemaster->id,
        ]);
        $this->campaign2 = factory(Campaign::class)->create([
            'title' => 'Dungeons and Dragons',
            'description' => 'I mean is a classic',
            'gamemaster_id' => $this->gamemaster->id,
        ]);
    }

    public function testIndexSucceeds()
    {
        $this->actingAs($this->gamemaster, 'jwt')
             ->json('get', '/api/campaigns')
             ->assertStatus(200)
             ->assertJson([
                 'data' => [
                     [
                         'id' => $this->campaign1->id,
                         'title' => 'The Lord of the Rings',
                         'description' => 'The original, except we slaughtered the book',
                     ],
                     [
                         'id' => $this->campaign2->id,
                         'title' => 'Dungeons and Dragons',
                         'description' => 'I mean is a classic',
                     ],
                 ],
             ]);
    }

    public function testIndexFailsIfNotAuthenticated()
    {
        $this->json('get', '/api/campaigns')
             ->assertStatus(401);
    }

    public function testShowSucceeds()
    {
        $this->actingAs($this->gamemaster, 'jwt')
             ->json('get', "/api/campaigns/{$this->campaign1->id}")
             ->assertStatus(200)
             ->assertJson([
                 'data' => [
                     'id' => $this->campaign1->id,
                     'title' => 'The Lord of the Rings',
                     'description' => 'The original, except we slaughtered the book',
                 ],
             ]);
    }

    public function testShowFailsIfUnauthenticated()
    {
        $this->json('get', "/api/campaigns/{$this->campaign1->id}")
             ->assertStatus(401);
    }

    public function testShowFailsIfNotExists()
    {
        $this->campaign1->delete();
        $this->actingAs($this->gamemaster, 'jwt')
             ->json('get', "/api/campaigns/{$this->campaign1->id}")
             ->assertStatus(404);
    }

    public function testStoreSucceeds()
    {
        $this->actingAs($this->gamemaster, 'jwt')
             ->json('post', '/api/campaigns', [
                 'title' => 'Dangerous world',
                 'description' => 'It is a dangerous world',
             ])
             ->assertStatus(201)
             ->assertHeader('Location');

        $this->assertDatabaseHas('campaigns', [
            'title' => 'Dangerous world',
            'description' => 'It is a dangerous world',
            'gamemaster_id' => $this->gamemaster->id,
        ]);
    }

    public function testStoreFailsIfUnauthenticated()
    {
        $this->json('post', '/api/campaigns')
             ->assertStatus(401);
    }

    public function testStoreFailsIfInvalid()
    {
        $this->actingAs($this->gamemaster, 'jwt')
             ->json('post', '/api/campaigns', [])
             ->assertStatus(422);
    }

    public function testStoreIntegration()
    {
        $response = $this->actingAs($this->gamemaster, 'jwt')
                         ->json('post', '/api/campaigns', [
                             'title' => 'Dangerous world',
                             'description' => 'It is a dangerous world',
                         ]);

        $response->assertStatus(201);

        $this->actingAs($this->gamemaster, 'jwt')
             ->json('get', $response->headers->get('Location'))
             ->assertStatus(200)
             ->assertJson([
                 'data' => [
                     'title' => 'Dangerous world',
                     'description' => 'It is a dangerous world',
                 ],
             ]);
    }

    public function testUpdateSucceeds()
    {
        $payload = ['title' => 'Dark days are coming'];
        $this->actingAs($this->gamemaster, 'jwt')
             ->json('put', "/api/campaigns/{$this->campaign1->id}", $payload)
             ->assertStatus(200);
        $this->assertDatabaseHas('campaigns', [
            'id' => $this->campaign1->id,
            'title' => 'Dark days are coming',
            'description' => 'The original, except we slaughtered the book',
        ]);
    }

    public function testUpdateFailsIfNotValid()
    {
        $payload = ['title' => ''];
        $this->actingAs($this->gamemaster, 'jwt')
             ->json('put', "/api/campaigns/{$this->campaign1->id}", $payload)
             ->assertStatus(422);
    }

    public function testUpdateFailsIfUnauthenticated()
    {
        $payload = ['title' => 'Dark days are coming'];
        $this->json('put', "/api/campaigns/{$this->campaign1->id}", $payload)
             ->assertStatus(401);
    }

    public function testUpdateIntegration()
    {
        $payload = ['title' => 'Dark days are coming'];
        $this->actingAs($this->gamemaster, 'jwt')
             ->json('put', "/api/campaigns/{$this->campaign1->id}", $payload)
             ->assertStatus(200);
        $this->actingAs($this->gamemaster, 'jwt')
             ->json('get', "/api/campaigns/{$this->campaign1->id}")
             ->assertStatus(200)
             ->assertJson([
                 'data' => [
                     'id' => $this->campaign1->id,
                     'title' => 'Dark days are coming',
                     'description' => 'The original, except we slaughtered the book',
                 ],
             ]);
    }

    public function testDestroySucceeds()
    {
        $this->actingAs($this->gamemaster, 'jwt')
             ->json('delete', "/api/campaigns/{$this->campaign1->id}")
             ->assertStatus(200);
        $this->assertDeleted($this->campaign1);
    }

    public function testDeleteFailsIfUnauthenticated()
    {
        $this->json('delete', "/api/campaigns/{$this->campaign1->id}")
             ->assertStatus(401);
    }

    public function testDestroyIntegration()
    {
        $this->actingAs($this->gamemaster, 'jwt')
             ->json('delete', "/api/campaigns/{$this->campaign1->id}")
             ->assertStatus(200);
        $this->actingAs($this->gamemaster, 'jwt')
             ->json('get', "/api/campaigns/{$this->campaign1->id}")
             ->assertStatus(404);
    }
}
