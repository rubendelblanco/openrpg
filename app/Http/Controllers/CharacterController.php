<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEditCharacterRequest;
use Illuminate\Http\Response;
use App\Character;

class CharacterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api,jwt');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(Character::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEditCharacterRequest
     * @return Response
     */
    public function store(StoreEditCharacterRequest $request)
    {

        $character = new Character;

        $character->user_id = $request->user()->id;
        $character->name = $request->name;
        $character->experience = $request->experience;
        $character->level = $this->getLevel($request->experience);


        if ($character->save()) {
            return response()->json(['message' => 'Personaje creado'], 200);
        }

        return response()->json(['message' => 'Ocurrio un error al guardar'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  Character  $character
     * @return \Illuminate\Http\Response
     */
    public function show(Character $character)
    {
        return Character::findOrFail($character->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreEditCharacterRequest  $request
     * @param  int  $character
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEditCharacterRequest $request, Character $character)
    {
        $some_possible_attributes = [
            'user' => 'user_id',
            'name' => 'name'
        ];

        foreach ($some_possible_attributes as $key => $value) {
            if (isset($request->{$key})){
                $character->{$value} = $request->{$key};
            }
        }

        //$character->user_id = $request->user;
        //$character->name = $request->name;
        $character->experience = $request->experience;
        $character->level = $this->getLevel($request->experience);

        if ($character->save()) {
            return response()->json(['message' => 'Cambios guardados'], 200);
        }

        return response()->json(['message' => 'Ocurrio un error al guardar'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Character $character
     * @return Response
     */
    public function destroy(Character $character)
    {
        try {
            $character->delete();
            return response()->json(['message' => 'Registro borrado'], 200);
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'Ocurrio un error al eliminar: '.$e->getMessage()], 500);
        }
    }

    private function getLevel(int $experience)
    {
        $table_rows = [
            [
                'min' => 10000,
                'max' => 50000,
                'level_inc' => 1,
                'delta' => 10000
            ],
            [
                'min' => 50000,
                'max' => 150000,
                'level_inc' => 5,
                'delta' => 20000
            ],
            [
                'min' => 150000,
                'max' => 300000,
                'level_inc' => 10,
                'delta' => 30000
            ],
            [
                'min' => 300000,
                'max' => 500000,
                'level_inc' => 15,
                'delta' => 40000
            ]
        ];

        if ($experience <= 9999) {
            return 0;
        }

        foreach ($table_rows as $row){
            if ($experience > $row['min'] && $experience <= $row['max']){
                return (int)(($experience-$row['min'])/$row['delta'])+$row['level_inc'];
            }
        };

        return (int)($experience-500000/50000)+20;
    }
}
