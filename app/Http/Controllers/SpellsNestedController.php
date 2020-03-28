<?php

namespace App\Http\Controllers;

use \Illuminate\Database\Eloquent\ModelNotFoundException;

use App\SpellList;
use App\Spell;
use App\Http\Requests\SpellStoreRequest;
use App\Http\Requests\SpellUpdateRequest;
use App\Http\Resources\Spells\SpellCollection;
use App\Http\Resources\Spells\Spell as SpellResource;
use Exception;

class SpellsNestedController extends ApiController
{
    public function index(SpellList $spellList)
    {
        return new SpellCollection(Spell::where(['list_id' => $spellList->id])->paginate());
    }

    public function store(SpellStoreRequest $request, SpellList $spellList)
    {
        throw new Exception("not implemented");
    }

    public function show(SpellList $spellList, Spell $spell)
    {
        if ($spellList->id != $spell->list_id) {
            return new ModelNotFoundException();
        }
        return new SpellResource($spell);
    }

    public function update(SpellUpdateRequest $request, SpellList $campaign, Spell $adventure)
    {
        throw new Exception("not implemented");
    }

    public function destroy(SpellList $spellList, Spell $spell)
    {
        throw new Exception("not implemented");
    }
}
