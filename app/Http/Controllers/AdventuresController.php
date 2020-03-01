<?php

namespace App\Http\Controllers;

use \Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Adventure;
use App\Campaign;
use App\Http\Requests\Adventures\StoreAdventure;
use App\Http\Requests\Adventures\UpdateAdventure;
use App\Http\Resources\Adventures\AdventureCollection;
use App\Http\Resources\Adventures\Adventure as AdventureResource;

class AdventuresController extends ApiController
{
    public function index(Campaign $campaign)
    {
        return new AdventureCollection(Adventure::where(['campaign_id' => $campaign->id])->paginate());
    }

    public function store(StoreAdventure $request, Campaign $campaign)
    {
        $adventure = new Adventure($request->validated());
        $adventure->campaign_id = $campaign->id;
        if ($adventure->save()) {
            return $this->sendMessage('Persisted successfully', 201)
                        ->header('Location', route('campaigns.adventures.show', [
                            'campaign' => $campaign->id,
                            'adventure' => $adventure->id,
                        ]));
        } else {
            return $this->sendMessage('Cannot persist', 500);
        }
    }

    public function show(Campaign $campaign, Adventure $adventure)
    {
        if ($adventure->campaign_id != $campaign->id) {
            throw new ModelNotFoundException();
        }
        return new AdventureResource($adventure);
    }

    public function update(UpdateAdventure $request, Campaign $campaign, Adventure $adventure)
    {
        if ($adventure->campaign_id != $campaign->id) {
            throw new ModelNotFoundException();
        }
        $validated = $request->validated();
        if ($adventure->update($validated)) {
            return $this->sendMessage('Persisted successfully');
        } else {
            return $this->sendMessage('Cannot persist', 500);
        }
    }

    public function destroy(Campaign $campaign, Adventure $adventure)
    {
        if ($adventure->campaign_id != $campaign->id) {
            throw new ModelNotFoundException();
        }
        if ($adventure->delete()) {
            return $this->sendMessage('Destroyed sucessfully');
        } else {
            return $this->sendMessage('Cannot destroy', 500);
        }
    }
}
