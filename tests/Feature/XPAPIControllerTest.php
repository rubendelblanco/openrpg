<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class XPAPIControllerTest extends TestCase
{
    private $endpoints;

    protected function setUp(){
        parent::setUp();
        $this->endpoints = ['maneuver','spell','travel','critical','kill','hp', 'bonus'];
    }

    /**
     * Test case parameters are missing in all endpoints because
     * all endpoints nedds at least one parameter regardless what method 
     * are using.
     *
     * @return void
     */
    public function testEndpointsYieldsErrorIfNotQueryGiven()
    {   
        foreach ($this->endpoints as $endpoint){
            $response = $this->json('GET', '/api/xp/'.$endpoint);
        }
        $response->assertStatus(422);
    }

    /**
     * Test case for a invalid query given in maneuver request
     *
     * @return void
     */
    public function testEndpointManeuverYieldsErrorIfInvalidQueryGiven()
    {   
        $response = $this->json('GET', '/api/xp/maneuver?man=j');
        $response->assertStatus(422);
        $response = $this->json('GET', '/api/xp/maneuver?man=mfa');
        $response->assertStatus(422);
        $response = $this->json('GET', '/api/xp/maneuver?man=mf&mod=t');
        $response->assertStatus(422);
        $response = $this->json('GET', '/api/xp/maneuver?man=mf&mod=-20');
        $response->assertStatus(422);
        $response = $this->json('GET', '/api/xp/maneuver?mod=2');
        $response->assertStatus(422);
    }

    /**
     * Test case for a valid query given in maneuver request
     *
     * @return void
     */
    public function testEndpointManeuverSuccessIfValidQueryGiven()
    {   
        $response = $this->json('GET', '/api/xp/maneuver?man=mf');
        $response->assertStatus(200);
        $response = $this->json('GET', '/api/xp/maneuver?man=ab&mod=0.5');
        $response->assertStatus(200);
        $response = $this->json('GET', '/api/xp/maneuver?man=ab&mod=1');
        $response->assertStatus(200);
    }

    /**
     * Test case receiving correct values for maneuver XP
     * 
     * @return void
     */
    public function testEndpointManeuverReturnsCorrectXPValues()
    {   
        $response = $this->json('GET', '/api/xp/maneuver?man=ed');
        $content = $response->getOriginalContent();
        $this->assertEquals(200, $content['message']);
        $response = $this->json('GET', '/api/xp/maneuver?man=ed&mod=2');
        $content = $response->getOriginalContent();
        $this->assertEquals(400, $content['message']);
        $response = $this->json('GET', '/api/xp/maneuver?man=d&mod=0.5');
        $content = $response->getOriginalContent();
        $this->assertEquals(50, $content['message']);
    }

    /**
     * Test case for a invalid query given in spell request
     *
     * @return void
     */
    public function testEndpointSpellYieldsErrorIfInvalidQueryGiven()
    {   
        $response = $this->json('GET', '/api/xp/spell?caster=j');
        $response->assertStatus(422);
        $response = $this->json('GET', '/api/xp/spell?caster=0');
        $response->assertStatus(422);
        $response = $this->json('GET', '/api/xp/spell?caster=1&spell=-3');
        $response->assertStatus(422);
        $response = $this->json('GET', '/api/xp/spell?caster=3&spell=sdfkg');
        $response->assertStatus(422);
        $response = $this->json('GET', '/api/xp/spell?caster=3&spell=2&mod=0');
        $response->assertStatus(422);
    }

    /**
     * Test case for a valid query given in spell request
     *
     * @return void
     */
    public function testEndpointSpellSuccessIfValidQueryGiven()
    {   
        $response = $this->json('GET', '/api/xp/spell?caster=1&spell=12&mod=2');
        $response->assertStatus(200);
    }

    /**
     * Test case receiving correct values for spell XP
     * 
     * @return void
     */
    public function testEndpointSpellReturnsCorrectXPValues()
    {   
        $response = $this->json('GET', '/api/xp/spell?caster=1&spell=12&mod=2');
        $content = $response->getOriginalContent();
        $this->assertEquals(400, $content['message']);
        $response = $this->json('GET', '/api/xp/spell?caster=8&spell=1');
        $content = $response->getOriginalContent();
        $this->assertEquals(30, $content['message']);
    }

    /**
     * Test case for a invalid query given in travel or hp request
     * "travel" and "hp" use the same controller. So it's irrelevant what
     * endpoint we use in these tests.
     *
     * @return void
     */
    public function testEndpointTravelOrHPYieldsErrorIfInvalidQueryGiven()
    {   
        $response = $this->json('GET', '/api/xp/travel?base=j');
        $response->assertStatus(422);
        $response = $this->json('GET', '/api/xp/hp?base=-18');
        $response->assertStatus(422);
        $response = $this->json('GET', '/api/xp/hp?mod=1.5');
        $response->assertStatus(422);
    }

    /**
     * Test case for a valid query given in travel or hp request
     *
     * @return void
     */
    public function testEndpointTravelOrHPSuccessIfValidQueryGiven()
    {   
        $response = $this->json('GET', '/api/xp/travel?base=1003&mod=12');
        $response->assertStatus(200);
    }

    /**
     * Test case receiving correct values for spell XP
     * 
     * @return void
     */
    public function testEndpointTravelOrHPReturnsCorrectXPValues()
    {   
        $response = $this->json('GET', '/api/xp/travel?base=189');
        $content = $response->getOriginalContent();
        $this->assertEquals(189, $content['message']);
        $response = $this->json('GET', '/api/xp/travel?base=150&mod=1.5');
        $content = $response->getOriginalContent();
        $this->assertEquals(225, $content['message']);
    }

    /**
     * Test case for a invalid query given critical request
     *
     * @return void
     */
    public function testEndpointCriticalYieldsErrorIfInvalidQueryGiven()
    {   
        $response = $this->json('GET', '/api/xp/critical?crit=j');
        $response->assertStatus(422);
        $response = $this->json('GET', '/api/xp/critical?crit=ea');
        $response->assertStatus(422);
        $response = $this->json('GET', '/api/xp/critical?mod=1.5');
        $response->assertStatus(422);
        $response = $this->json('GET', '/api/xp/critical?crit=a&level=1.5');
        $response->assertStatus(422);
        $response = $this->json('GET', '/api/xp/critical?crit=a&level=0');
        $response->assertStatus(422);
    }

    /**
     * Test case for a valid query given in critical
     *
     * @return void
     */
    public function testEndpointCriticalSuccessIfValidQueryGiven()
    {   
        $response = $this->json('GET', '/api/xp/critical?crit=E&level=2');
        $response->assertStatus(200);
        $response = $this->json('GET', '/api/xp/critical?crit=a&level=5&mod=1.5');
        $response->assertStatus(200);
    }

    /**
     * Test case receiving correct values for critical XP
     * 
     * @return void
     */
    public function testEndpointCriticalReturnsCorrectXPValues()
    {   
        $response = $this->json('GET', '/api/xp/critical?crit=E&level=2');
        $content = $response->getOriginalContent();
        $this->assertEquals(50, $content['message']);
        $response = $this->json('GET', '/api/xp/critical?crit=a&level=12');
        $content = $response->getOriginalContent();
        $this->assertEquals(60, $content['message']);
        $response = $this->json('GET', '/api/xp/critical?crit=a&level=12&mod=2');
        $content = $response->getOriginalContent();
        $this->assertEquals(120, $content['message']);
    }

    /**
     * Test case for a valid query given in critical
     *
     * @return void
     */
    public function testEndpointKillSuccessIfValidQueryGiven()
    {   
        $response = $this->json('GET', '/api/xp/kill?attack=8&def=2');
        $response->assertStatus(200);
        $response = $this->json('GET', '/api/xp/kill?attack=8&def=2&mod=1.5');
        $response->assertStatus(200);
    }

    /**
     * Test case receiving correct values for critical XP
     * 
     * @return void
     */
    public function testEndpointKillReturnsCorrectXPValues()
    {   
        $response = $this->json('GET', '/api/xp/kill?attack=8&def=2');
        $content = $response->getOriginalContent();
        $this->assertEquals(80, $content['message']);
        $response = $this->json('GET', '/api/xp/kill?attack=2&def=5');
        $content = $response->getOriginalContent();
        $this->assertEquals(350, $content['message']);
        $response = $this->json('GET', '/api/xp/kill?attack=2&def=5&mod=3');
        $content = $response->getOriginalContent();
        $this->assertEquals(1050, $content['message']);
    }

    public function testEndpointBonusYieldsErrorIfInvalidQueryGiven()
    {   
        $response = $this->json('GET', '/api/xp/bonus?crit=jk$level=12');
        $response->assertStatus(422);
        $response = $this->json('GET', '/api/xp/bonus?crit=j$level=-2');
        $response->assertStatus(422);
    }

    /**
     * Test case for a valid query given in bonus
     *
     * @return void
     */
    public function testEndpointBonusSuccessIfValidQueryGiven()
    {   
        $response = $this->json('GET', '/api/xp/bonus?level=8&code=E');
        $response->assertStatus(200);
        $response = $this->json('GET', '/api/xp/bonus?level=25&code=j');
        $response->assertStatus(200);
    }

    /**
     * Test case receiving correct values for bonus XP
     * 
     * @return void
     */
    public function testEndpointBonusReturnsCorrectXPValues()
    {   
        $row_21 = [
            'a' => 0,
            'b' => 0,
            'c' => 50,
            'd' => 100,
            'e' => 200,
            'f' => 400,
            'g' => 600,
            'h' => 800,
            'i' => 1000,
            'j' => 1500,
            'k' => 2000,
            'l' => 2500
        ];
        $response = $this->json('GET', '/api/xp/bonus?level=1&code=a');
        $content = $response->getOriginalContent();
        $this->assertEquals(50, $content['message']);
        $response = $this->json('GET', '/api/xp/bonus?level=2&code=a');
        $content = $response->getOriginalContent();
        $this->assertEquals(50, $content['message']);
        $response = $this->json('GET', '/api/xp/bonus?level=3&code=a');
        $content = $response->getOriginalContent();
        $this->assertEquals(40, $content['message']);
        $response = $this->json('GET', '/api/xp/bonus?level=8&code=E');
        $content = $response->getOriginalContent();
        $this->assertEquals(340, $content['message']);
        $response = $this->json('GET', '/api/xp/bonus?level=25&code=j');
        $content = $response->getOriginalContent();
        $this->assertEquals(1500, $content['message']);
        $response = $this->json('GET', '/api/xp/bonus?level=12&code=a');
        $content = $response->getOriginalContent();
        $this->assertEquals(0, $content['message']);

        /* Testing the last row (level 21). If the level is 21 or higher, the response
         must be the same */
        foreach ($row_21 as $code => $value){
            $response = $this->json('GET', '/api/xp/bonus?level=21&code='.$code);
            $content = $response->getOriginalContent();
            $this->assertEquals($value, $content['message']);
            $response = $this->json('GET', '/api/xp/bonus?level=30&code='.$code);
            $content = $response->getOriginalContent();
            $this->assertEquals($value, $content['message']);
        }
    }
}
