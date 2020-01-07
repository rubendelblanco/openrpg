<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SpellStoreRequest;
use App\Spell;

class SpellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_payload = $request->input("q");
        if ($search_payload) {
            $data = Spell::search($search_payload)->get();
        } else {
            $data = Spell::all();
        }
        return response()->json([
            "data" => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\SpellStoreRequest
     * @return \Illuminate\Http\Response
     */
    public function store(SpellStoreRequest $request)
    {
        $spell = new Spell;

        $validated = $request->validated();

        $spell->name = $validated['name'];
        $spell->level = $validated['level'];
        $spell->description = $validated['description'];
        $spell->list_name = $validated['list_name'];
        $spell->code = $validated['code'];
        $spell->class = $validated['class'];
        $spell->subclass = $validated['subclass'];
        // TODO: JSON data to be manually validated
        $spell->effect_area = $validated['effect_area'];
        $spell->duration = $validated['duration'];
        $spell->range = $validated['range'];
        // End TODO
        $spell->notes = $validated['notes'];
        $spell->list_id = $validated['list_id'];

        if ($spell->save()) {
            return response()->json([
                'data' => json_decode($spell->toJson(JSON_PRETTY_PRINT))
            ], 201);
        }

        return response()->json(['message' => ''], 500);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
