<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Http\Requests\Campaign\StoreCampaign;
use App\Http\Requests\Campaign\UpdateCampaign;
use App\Http\Resources\Campaigns\Campaign as CampaignResource;
use App\Http\Resources\Campaigns\CampaignCollection;

class CampaignsController extends ApiController
{
    public function index()
    {
        return new CampaignCollection(Campaign::paginate());
    }

    public function store(StoreCampaign $request)
    {
        $validated = $request->validated();
        $validated['gamemaster_id'] = $request->user()->id;
        $campaign = Campaign::create($validated);
        return $this->sendMessage('Created successfully', 201)
                    ->header('Location', route('campaigns.show', ['campaign' => $campaign]));
    }

    public function show(Campaign $campaign)
    {
        return new CampaignResource($campaign);
    }

    public function update(UpdateCampaign $request, Campaign $campaign)
    {
        $validated = $request->validated();
        if ($campaign->update($validated)) {
            return $this->sendMessage('Updated successfully');
        } else {
            return $this->sendMessage('Cannot persist changes', 422);
        }
    }

    public function destroy(Campaign $campaign)
    {
        if ($campaign->delete()) {
            return $this->sendMessage('Destroyed successfully');
        } else {
            return $this->sendMessage('Cannot destroy this campaign');
        }
    }
}
