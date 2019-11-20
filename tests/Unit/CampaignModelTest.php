<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Adventure;
use App\Campaign;
use App\User;

class CampaignModelTest extends TestCase
{
    public function testLintFactory()
    {
        $campaign = factory(Campaign::class)->create();
        $saved_campaign = Campaign::find($campaign->id);
        $this->assertEquals($campaign->title, $saved_campaign->title);
    }

    public function testCampaignIsInvalidWithoutTitle()
    {
        $this->expectException(QueryException::class);
        $campaign = factory(Campaign::class)->create([
            "title" => null,
        ]);
    }

    public function testCampaignIsInvalidWithoutGamemaster()
    {
        $this->expectException(QueryException::class);
        $campaign = factory(Campaign::class)->create([
            "gamemaster_id" => null,
        ]);
    }

    public function testCampaignBelongsToGamemaster()
    {
        $user = factory(User::class)->create();
        $campaign = factory(Campaign::class)->create([
            "gamemaster_id" => $user->id,
        ]);
        $this->assertEquals($campaign->gamemaster->id, $user->id);
    }

    public function testCampaignHasAdventures()
    {
        $campaign = factory(Campaign::class)->create();
        $adventure = factory(Adventure::class)->create([
            "campaign_id" => $campaign->id,
        ]);

        $this->assertCount(1, $campaign->adventures);
        $this->assertEquals($campaign->adventures()->first()->id, $adventure->id);
    }
}
