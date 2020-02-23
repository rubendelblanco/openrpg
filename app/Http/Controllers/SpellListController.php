<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SpellList;
use App\Http\Requests\SpellListStoreRequest;

class SpellListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(["data" => SpellList::all()], 200);
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

        if (! array_filter(config('rolemaster.spell_list_type'), function ($item) use ($validated) {
            return $item['code'] === $validated['list_type'];
        })) {
            return response()->json(['error' => 'unknown list type'], 422);
        }

        $spellList->description = $validated['description'];
        $spellList->notes = $validated['notes'];
        $spellList->list_type = $validated['list_type'];
        $spellList->name = $validated['name'];


        if ($spellList->save()) {
            return response()
                ->json(
                    ['data' => json_decode($spellList->toJson(JSON_PRETTY_PRINT))],
                    201,
                    ['Location' => route("spell-lists.show", ['spell' => $spellList->id])]
                );
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
            return response()->json(['message' => 'Spell list not found'], 404);
        }

        try {
            $spellList->delete();
            return response()->json(['message' => 'Lista de Feitizo borrado'], 204);
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'Ocurrio un error al eliminar: '.$e->getMessage()], 500);
        }
    }
}
