<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * This class calculates all the experience points cases of
 * Rolemaster Fantasy system (chapter 23.0, basic manual) and
 * Creatures & monsters manuals
 */
class XPController extends Controller
{
    /**
     * Returns a maneuver experience points
     *
     * @param Request $request 
     * @return array response
     */
    public function getManeuverXP(Request $request)
    {
        $table = array(
            'mf' => '5',
            'f' => '10',
            'm' => '50',
            'd' => '100',
            'md' => '150',
            'ed' => '200',
            'lc' => '300',
            'ab' => '500'
        );
        $critPattern = '/^(mf|f|m|d|md|ed|lc|ab)$/i';
        $request->validate([
            'man' => 'required',
            'mod' => 'numeric|min:0'
        ]);
        $maneuver = strtolower($request->man);
        $modifier = $this->getModifier($request);

        if (!isset($table[$maneuver])) {
            return response()->json(
                ['response' => 'KO', 'message' => 'Maneuver code undefined'],
                400
            );
        }

        return ['response' => 'OK', 'message' => ($table[$maneuver] * $modifier)];
    }

    /**
     * Returns experience points for cast a spell
     *
     * @param Request $request
     * @return array
     */
    public function getSpellXP(Request $request)
    {
        $request->validate([
            'caster' => 'required|integer|min:1',
            'spell' => 'required|integer|min:1',
            'mod' => 'numeric|min:0'
        ]);
        $modifier = $this->getModifier($request);
        $total = (100 - (10 * ($request->caster - $request->spell))) * $modifier;

        if ($total > 200) {
            $total = 200;
        } else if ($total < 0) {
            $total = 0;
        }

        return ['response' => 'OK', 'message' => $total];
    }

    /**
     * Returns experience points for travel and/or hit points delivered and received.
     * The calculation method is the same for both, so we use the same function. 
     *
     * @param Request $request
     * @return array
     */
    public function getTravelOrHPXP(Request $request)
    {
        $request->validate([
            'base' => 'required|integer|min:0',
            'mod' => 'numeric|min:0'
        ]);
        $modifier = $this->getModifier($request);
        return ['response' => 'OK', 'message' => $request->base * $modifier];
    }

    /**
     * Returns experience points for make a critical hit to a foe
     *
     * @param Request $request
     * @return void
     */
    public function getCriticalXP(Request $request)
    {
        $table = array(
            'a' => '1',
            'b' => '2',
            'c' => '3',
            'd' => '4',
            'e' => '5'
        );
        $critPattern = '/^[abcde]$/i';
        $request->validate([
            'crit' => 'required|regex:$critPattern',
            'level' => 'required|numeric|min:1',
            'mod' => 'numeric|min:0'
        ]);
        $critical = strtolower($request->crit);

        if (!isset($table[$critical])) {
            return response()->json(
                ['response' => 'KO', 'message' => 'Critical code undefined'],
                400
            );
        }

        $modifier = $this->getModifier($request);
        $total = ($table[$critical] * 5 * $request->level) * $modifier;
        return ['response' => 'OK', 'message' => $total];
    }

    /**
     * Returns experience points for kill (or beat) a foe
     *
     * @param Request $request
     * @return array
     */
    public function getKillXP(Request $request)
    {
        $request->validate([
            'attack' => 'required|numeric|min:1',
            'def' => 'required|numeric|min:1',
            'mod' => 'numeric|min:0'
        ]);
        $modifier = $this->getModifier($request);
        $diff = $request->def - $request->attack;

        if ($diff >= 0) {
            $total = 200 + ($diff * 50);
        } else {
            if ($diff == -1) {
                $total = 150;
            } else if ($diff == -2 or $diff == -3) {
                $total = 150 + (($diferencia + 1) * 20);
            } else {
                $total = 110 + (($diferencia + 3) * 10);
            }
        }

        if ($total < 0) {
            $total = 0;
        }

        $total = $total * $modifier;
        return ['response' => 'OK', 'message' => $total];
    }

    /**
     * Returns bonus experience points for beat a foe as it is
     * described in Creatures & monsters manual
     *
     * @param Request $request
     * @return void
     */
    public function bonusXP(Request $request)
    {
        $codePattern = '/^[abcdefghijkl]$/i';
        $request->validate([
            'level' => 'required|numeric|min:1',
            'code' => 'required|regex:$codePattern',
        ]);
        $table = [
            [
                'a' => 50,
                'b' => 75,
                'c' => 100,
                'd' => 200,
                'e' => 400,
                'f' => 800,
                'g' => 1200,
                'h' => 1600,
                'i' => 2000,
                'j' => 3000,
                'k' => 4000,
                'l' => 5000
            ],
            [
                'a' => 40,
                'b' => 60,
                'c' => 95,
                'd' => 190,
                'e' => 380,
                'f' => 760,
                'g' => 1140,
                'h' => 1520,
                'i' => 1900,
                'j' => 2850,
                'k' => 3800,
                'l' => 4750
            ]
        ];
        $inc = [
            'a' => 10,
            'b' => 10,
            'c' => 5,
            'd' => 10,
            'e' => 20,
            'f' => 40,
            'g' => 60,
            'h' => 80,
            'i' => 100,
            'j' => 150,
            'k' => 200,
            'l' => 250
        ];
        $code = strtolower($request->code);
        $level = $request->level;

        if (!isset($table[0][$code])) {
            return response()->json(
                ['response' => 'KO', 'message' => 'Bonus code undefined'],
                400
            );
        }

        if ($level == 1 || $level == 2) {
            return ['response' => 'OK', 'message' => $table[0][$code]];
        } else if ($level == 3 || $level == 4) {
            return ['response' => 'OK', 'message' => $table[0][$code]];
        } else {
            $row = ceil($level / 2);
            $total = $table[count($table) - 1][$code] - ($row - (count($table) * $inc[$code]));
            return ['response' => 'OK', 'message' => $total];
        }
    }

    /**
     * Calculates the modifier if the request has one. If not it will be 1.
     * 
     * @param Request $request
     * @return string modifier/multiplier.
     */
    private function getModifier(Request $request)
    {
        if ($request->has('mod')) {
            return $request->mod;
        } else {
            return '1';
        }
    }
}
