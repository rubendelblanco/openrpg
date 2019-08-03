<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

class DiceController extends Controller
{
    public function roll(Request $request)
    {
        /*
         * /\d+d\d+/ matches for a single command (1d10, 5d5, 10d20...)
         * $diceRegex matches for either a roll or a comma separated list.
         * Note that this doesn't capture. It is just used for validation.
         */
        $diceRegex = "/^\d+d\d+(,\d+d\d+)*$/i";

        $validator = Validator::make($request->all(), [
            "q" => ["required", "regex:$diceRegex"],
        ], [
            /* Provide more friendly messages when q is not valid. */
            "q.required" => "You must provide a roll set.",
            "q.regex" => "You provided an invalid roll set.",
        ]);
        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()->all(),
            ], 422);
        }

        $rollCommand = strtolower($request->get("q"));
        return response()->json($this->processRoll($rollCommand));
    }

    /**
     * Actually processes a roll set combination.
     *
     * This function assumes that the roll set has already be validated and
     * it is valid or at least not malformed. The combination is a string
     * of comma separated rolls, each roll having the form xDy, where x and y
     * being natural numbers with different meanings. We will ignore the
     * dice semantics here and accept any kind of dice for the moment, so
     * rolls such as 10d25 or 13D26 are totally valid here.
     *
     * @param string $rollSet the list of rolls to yield.
     * @return array processed list of rolls.
     */
    private function processRoll(string $rollSet)
    {
        /* Accumulator object to store partial results of rolls. */
        $result = [
            "dice"  => 0,  /* Number of dice that were roll in total. */
            "rolls" => [], /* Outcomes for each die that was rolled. */
            "sum"   => 0,  /* Sum of all outcomes. */
        ];

        $rolls = explode(",", strtolower($rollSet));
        foreach ($rolls as $roll) {
            /* Decode the command to see how many dice to roll. */
            [$diceToRoll, $facesInDie] = explode("d", $roll);

            /* Always roll each die separately, even if more than one. */
            for ($i = 0; $i < $diceToRoll; $i++) {
                $randomValue = random_int(1, $facesInDie);

                /* Update the result accumulators. */
                $result["dice"]++;
                $result["rolls"][] = [
                    "size"    => intval($facesInDie),
                    "outcome" => $randomValue,
                ];
                $result["sum"] += $randomValue;
            }
        }
        return $result;
    }
}
