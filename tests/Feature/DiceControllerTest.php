<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
     * Test case that extracts deterministic properties for a single roll.
     * Only the number of rolled dices and the faces in the dice are tested.
     */
    public function testEndpointYieldsNumberOfDicesSimple()
    {
        $response = $this->get('/api/roll?q=1d6');
        $response->assertJson([
            "dices" => 1,
            "size" => [6],
        ]);
    }

    public function testEndpointAcceptsUppercaseCommands()
    {
        $response = $this->get('/api/roll?q=1d6,1D10,1d5');
        $response->assertJson([
            "dices" => 3,
            "size" => [6, 10, 5],
        ]);
    }

    /**
     * Test case that extracts deterministic properties for multiple dices.
     * This test case is important because if you pass a xDy value, with x>1,
     * you have to test that the system treats it as multiple dices.
     */
    public function testEndpointYieldsNumberOfDicesMultiple()
    {
        $response = $this->get('/api/roll?q=2d5');
        $response->assertJson([
            "dices" => 2,
            "size" => [5, 5],
        ]);
    }

    /**
     * Test case that extracts deterministic properties for a list of dices.
     * This test case is important because the ordering for the size and
     * outcome array in the response is important.
     */
    public function testEndpointYieldsNumberOfDicesList()
    {
        $response = $this->get('/api/roll?q=1d6,2d10');
        $response->assertJson([
            "dices" => 3,
            "size" => [6, 10, 10],
        ]);
    }
}
