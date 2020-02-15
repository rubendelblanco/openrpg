<?php

namespace Tests\Feature;

use Tests\TestCase;

class DiceController extends TestCase
{
    /**
     * Test case missing any querystring parameters, including q.
     * If you don't provide q, the endpoint will yield an error.
     */
    public function testEndpointYieldsErrorIfNoQueryGiven()
    {
        $response = $this->get('/api/roll');
        $response->assertStatus(422);
    }

    /**
     * Test case with an invalid query format for q.
     * If you don't provide a valid roll command list, it will fail.
     */
    public function testEndpointYieldsErrorIfInvalidQueryGiven()
    {
        $response = $this->get('/api/roll?q=Invalid');
        $response->assertStatus(422);
    }

    /**
     * Test case with a valid query format for q.
     * If you provide a valid format for q, it will succeed.
     */
    public function testEndpointSucceedsIfValidQueryGiven()
    {
        $response = $this->get('/api/roll?q=1d10');
        $response->assertStatus(200);
    }

    /**
     * Test case that sums the outcomes and tests it is correct.
     */
    public function testEndpointSumsTheOutcomes()
    {
        $response = $this->get('/api/roll?q=2d6');
        $content = $response->getOriginalContent();
        $outcome1 = $content["rolls"][0]["outcome"];
        $outcome2 = $content["rolls"][1]["outcome"];
        $sum = $content["sum"];
        $this->assertEquals($sum, $outcome1 + $outcome2);
    }

    /**
     * Test case that extracts deterministic properties for a single roll.
     * Only the number of rolled die and the faces in the die are tested.
     */
    public function testEndpointYieldsNumberOfDicesSimple()
    {
        $response = $this->get('/api/roll?q=1d6');
        $response->assertJson([
            "dice" => 1,
        ]);
        $content = $response->getOriginalContent();
        $this->assertCount(1, $content["rolls"]);
        $this->assertEquals($content["rolls"][0]["size"], 6);
    }

    public function testEndpointAcceptsUppercaseCommands()
    {
        $response = $this->get('/api/roll?q=1d6,1D10,1d5');
        $response->assertJson([
            "dice" => 3,
        ]);
        $content = $response->getOriginalContent();
        $this->assertCount(3, $content["rolls"]);
        $this->assertEquals($content["rolls"][0]["size"], 6);
        $this->assertEquals($content["rolls"][1]["size"], 10);
        $this->assertEquals($content["rolls"][2]["size"], 5);
    }

    /**
     * Test case that extracts deterministic properties for multiple dice.
     * This test case is important because if you pass a xDy value, with x>1,
     * you have to test that the system treats it as multiple dice.
     */
    public function testEndpointYieldsNumberOfDicesMultiple()
    {
        $response = $this->get('/api/roll?q=2d5');
        $response->assertJson([
            "dice" => 2,
        ]);
        $content = $response->getOriginalContent();
        $this->assertCount(2, $content["rolls"]);
        $this->assertEquals($content["rolls"][0]["size"], 5);
        $this->assertEquals($content["rolls"][1]["size"], 5);
    }

    /**
     * Test case that extracts deterministic properties for a list of dice.
     * This test case is important because the ordering for the size and
     * outcome array in the response is important.
     */
    public function testEndpointYieldsNumberOfDicesList()
    {
        $response = $this->get('/api/roll?q=1d6,2d10');
        $response->assertJson([
            "dice" => 3,
        ]);
        $content = $response->getOriginalContent();
        $this->assertArrayHasKey("rolls", $content);
        $this->assertCount(3, $content["rolls"]);
        $this->assertEquals($content["rolls"][0]["size"], 6);
        $this->assertEquals($content["rolls"][1]["size"], 10);
        $this->assertEquals($content["rolls"][2]["size"], 10);
    }
}
