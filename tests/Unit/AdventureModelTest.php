<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Adventure;
use App\Campaign;

class AdventureModelTest extends TestCase
{
    public function testLintFactory()
    {
        $adventure = factory(Adventure::class)->create();
        $saved_adventure = Adventure::find($adventure->id);
        $this->assertEquals($adventure->title, $saved_adventure->title);
    }

    public function testAdventureIsInvalidWithoutTitle()
    {
        $this->expectException(QueryException::class);
        $adventure = factory(Adventure::class)->create([
            "title" => null,
        ]);
    }

    public function testAdventureIsInvalidWithoutCampaign()
    {
        $this->expectException(QueryException::class);
        $adventure = factory(Adventure::class)->create([
            "campaign_id" => null,
        ]);
    }

    public function testAdventureBelongsToCampaign()
    {
        $campaign = factory(Campaign::class)->create();
        $adventure = factory(Adventure::class)->create([
            "campaign_id" => $campaign->id,
        ]);
        $this->assertEquals($adventure->campaign->id, $campaign->id);
    }
}
