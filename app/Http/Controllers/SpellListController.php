<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\SpellList;
use App\Spell;
use App\Http\Requests\SpellListStoreRequest;
use App\Http\Requests\SpellListUpdateRequest;
use App\Http\Controllers\ApiController;


class SpellListController extends ApiController
{
    protected $messageKey = 'data';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sendMessage(SpellList::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpellListStoreRequest $request)
    {
        $spellList = new SpellList;

        $validated = $request->validated();

        if (!array_filter(config('rolemaster.spell_list_type'), function ($item) use ($validated) {
            return $item['code'] === $validated['list_type'];
        })) {
            return $this->sendValidationError('unknown list type');
        }

        $spellList->fill($validated);

        if ($spellList->save()) {
            $message = json_decode($spellList->toJson(JSON_PRETTY_PRINT));
            $headers = ['Location' => route("spell-lists.show", ['spell_list' => $spellList->id])];
            return $this->sendMessage($message, 201, $headers);
        }

        return response()->json(['message' => 'Ocurrio un error al crear el feitizo'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sl = SpellList::find($id);
        if ($sl) {
            return $this->sendMessage(json_decode($sl->toJson(JSON_PRETTY_PRINT)));
        }
        return $this->sendNotFound('Spell list not found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SpellList  $sl
     * @return \Illuminate\Http\Response
     */
    public function update(SpellListUpdateRequest $request, SpellList $spellList)
    {
        $validated = $request->validated();
        $spellList->update($validated);

        // Update spell.list_name to refresh searching text capabilities
        $updated = Spell::where('list_id', $spellList->id)->update(['list_name' => $validated['name']]);
        if ($updated > 0) {
            Log::info("$updated spells have been updated", ['id' => $spellList->id, 'action' => 'update']);
        } else {
            Log::notice("no related spells have been updated. Empty list?", ['id' => $spellList->id, 'action' => 'update']);
        }

        if ($spellList->save()) {
            return $this->sendMessage(json_decode($spellList->toJson(JSON_PRETTY_PRINT)));
        }

        return $this->sendInternalError('no se pudo actualizar la lista del hechizo');
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spellList = SpellList::find($id);

        if (!$spellList) {
            return $this->sendNotFound('Spell list not found');
        }

        try {
            if ($spellList->delete()) {
                return $this->sendNoContent('Lista de feitizo borrado');
            } else {
                return $this->sendInternalError('No se ha borrado nada');
            }
        } catch (\Exception $e) {
            return $this->sendInternalError('Ocurrio un error al eliminar: ' . $e->getMessage());
        }
    }
}
