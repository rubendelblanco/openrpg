<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Adventure;
use App\User;
use App\Campaign;

class AdventuresControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;

    protected $campaign1;

    protected $campaign2;

    protected $adventure1;

    protected $adventure2;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->campaign1 = factory(Campaign::class)->create([
            'gamemaster_id' => $this->user->id,
        ]);
        $this->campaign2 = factory(Campaign::class)->create([
            'gamemaster_id' => $this->user->id,
        ]);
        $this->adventure1 = factory(Adventure::class)->create([
            'campaign_id' => $this->campaign1->id,
            'title' => 'The Haunted Forest',
            'description' => 'What kind of mistery would emerge',
        ]);
        $this->adventure2 = factory(Adventure::class)->create([
            'campaign_id' => $this->campaign2->id,
            'title' => 'The Dangerous Animal',
            'description' => 'An animal very dangerous',
        ]);
    }

    public function testIndexSucceeds()
    {
        $this->actingAs($this->user, 'jwt')
             ->json('get', "/api/campaigns/{$this->campaign2->id}/adventures")
             ->assertStatus(200)
             ->assertJson([
                 'data' => [
                     [
                         'id' => $this->adventure2->id,
                         'title' => 'The Dangerous Animal',
                         'description' => 'An animal very dangerous',
                     ],
                 ],
             ]);
    }

    public function testIndexFailsIfCampaignNotFound()
    {
        $this->campaign2->delete();
        $this->actingAs($this->user, 'jwt')
             ->json('get', "/api/campaigns/{$this->campaign2->id}/adventures")
             ->assertStatus(404);
    }

    public function testIndexFailsIfNotAuthenticated()
    {
        $this->json('get', "/api/campaigns/{$this->campaign2->id}/adventures")
             ->assertStatus(401);
    }

    public function testShowSucceeds()
    {
        $this->actingAs($this->user, 'jwt')
             ->json('get', "/api/campaigns/{$this->campaign2->id}/adventures/{$this->adventure2->id}")
             ->assertStatus(200)
             ->assertJson([
                 'data' => [
                     'id' => $this->adventure2->id,
                     'title' => 'The Dangerous Animal',
                     'description' => 'An animal very dangerous',
                 ],
             ]);
    }

    public function testShowFailsIfUnauthenticated()
    {
        $this->json('get', "/api/campaigns/{$this->campaign2->id}/adventures/{$this->adventure2->id}")
             ->assertStatus(401);
    }

    public function testShowFailsIfNotExists()
    {
        $this->adventure2->delete();
        $this->actingAs($this->user, 'jwt')
             ->json('get', "/api/campaigns/{$this->campaign2->id}/adventures/{$this->adventure2->id}")
             ->assertStatus(404);
    }

    public function testShowFailsIfCampaignMismatches()
    {
        $this->actingAs($this->user, 'jwt')
             ->json('get', "/api/campaigns/{$this->campaign1->id}/adventures/{$this->adventure2->id}")
             ->assertStatus(404);
    }

    public function testStoreSucceeds()
    {
        $payload = [
            'title' => 'The Evil Tower',
            'description' => 'Plant 3: Demons',
        ];
        $this->actingAs($this->user, 'jwt')
             ->json('post', "/api/campaigns/{$this->campaign2->id}/adventures", $payload)
             ->assertStatus(201)
             ->assertHeader('Location');
        $this->assertDatabaseHas('adventures', [
            'title' => 'The Evil Tower',
            'description' => 'Plant 3: Demons',
            'campaign_id' => $this->campaign2->id,
        ]);
    }

    public function testStoreFailsIfUnauthenticated()
    {
        $payload = [
            'title' => 'The Evil Tower',
            'description' => 'Plant 3: Demons',
        ];
        $this->json('post', "/api/campaigns/{$this->campaign2->id}/adventures", $payload)
             ->assertStatus(401);
    }

    public function testStoreFailsIfInvalid()
    {
        $payload = [
            'description' => 'Plant 3: Demons',
        ];
        $this->actingAs($this->user, 'jwt')
             ->json('post', "/api/campaigns/{$this->campaign2->id}/adventures", $payload)
             ->assertStatus(422);
    }

    public function testStoreIntegration()
    {
        $payload = [
            'title' => 'The Evil Tower',
            'description' => 'Plant 3: Demons',
        ];

        $response = $this->actingAs($this->user, 'jwt')
                         ->json('post', "/api/campaigns/{$this->campaign2->id}/adventures", $payload);
        $response->assertStatus(201);

        $this->actingAs($this->user, 'jwt')
             ->json('get', $response->headers->get('Location'))
             ->assertJson([
                 'data' => [
                     'title' => 'The Evil Tower',
                     'description' => 'Plant 3: Demons',
                 ],
             ]);
    }

    public function testUpdateSucceeds()
    {
        $payload = ['title' => 'A Dangerous Creature'];
        $this->actingAs($this->user, 'jwt')
             ->json('put', "/api/campaigns/{$this->campaign2->id}/adventures/{$this->adventure2->id}", $payload)
             ->assertStatus(200);
        $this->assertDatabaseHas('adventures', [
            'id' => $this->adventure2->id,
            'title' => 'A Dangerous Creature',
            'description' => 'An animal very dangerous',
            'campaign_id' => $this->campaign2->id,
        ]);
    }

    public function testUpdateFailsIfNotValid()
    {
        $payload = ['title' => ''];
        $this->actingAs($this->user, 'jwt')
             ->json('put', "/api/campaigns/{$this->campaign2->id}/adventures/{$this->adventure2->id}", $payload)
             ->assertStatus(422);
    }

    public function testUpdateFailsIfUnauthenticated()
    {
        $payload = ['title' => 'A Dangerous Creature'];
        $this->json('put', "/api/campaigns/{$this->campaign2->id}/adventures/{$this->adventure2->id}", $payload)
             ->assertStatus(401);
    }

    public function testUpdateFailsIfCampaignMismatches()
    {
        $payload = ['title' => 'A Dangerous Creature'];
        $this->actingAs($this->user, 'jwt')
             ->json('put', "/api/campaigns/{$this->campaign1->id}/adventures/{$this->adventure2->id}", $payload)
             ->assertStatus(404);
    }

    public function testUpdateIntegration()
    {
        $payload = ['title' => 'A Dangerous Creature'];
        $this->actingAs($this->user, 'jwt')
             ->json('put', "/api/campaigns/{$this->campaign2->id}/adventures/{$this->adventure2->id}", $payload)
             ->assertStatus(200);
        $this->actingAs($this->user, 'jwt')
             ->json('get', "/api/campaigns/{$this->campaign2->id}/adventures/{$this->adventure2->id}")
             ->assertStatus(200)
             ->assertJson([
                 'data' => [
                     'title' => 'A Dangerous Creature',
                     'description' => 'An animal very dangerous',
                 ],
             ]);
    }

    public function testDestroySucceeds()
    {
        $this->actingAs($this->user, 'jwt')
             ->json('delete', "/api/campaigns/{$this->campaign2->id}/adventures/{$this->adventure2->id}")
             ->assertStatus(200);
        $this->assertDeleted($this->adventure2);
    }

    public function testDestroyFailsIfUnauthenticated()
    {
        $this->json('delete', "/api/campaigns/{$this->campaign2->id}/adventures/{$this->adventure2->id}")
             ->assertStatus(401);
    }

    public function testDestroyFailsIfCampaignMismatches()
    {
        $this->actingAs($this->user, 'jwt')
             ->json('delete', "/api/campaigns/{$this->campaign1->id}/adventures/{$this->adventure2->id}")
             ->assertStatus(404);
    }

    public function testDestroyIntegration()
    {
        $this->actingAs($this->user, 'jwt')
             ->json('delete', "/api/campaigns/{$this->campaign2->id}/adventures/{$this->adventure2->id}")
             ->assertStatus(200);
        $this->actingAs($this->user, 'jwt')
             ->json('get', "/api/campaigns/{$this->campaign2->id}/adventures/{$this->adventure2->id}")
             ->assertStatus(404);
    }
}
