<?php

namespace Tests\Integration\Classes;


use GameDisplay\RiotDisplay\API\Api;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
//todo: Test with invalid summoner name
class RiotApiTest extends \TestCase
{
    /**
     * @var \IntegrationTester
     */
    use DatabaseTransactions, DatabaseMigrations;

    protected $API;

    public function setUp()
    {
        $this->API = new Api();
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    // tests
    public function testCreatingObjectShouldHaveApiKeyNotNull()
    {
        $this->assertNotNull($this->API->getApiKey());
    }

    public function testRequestDDragonVersionMethodAndSeeThatTheVersionIsSetToMatchReg(){
        $this->API->requestDDragonVersion();
        $this->assertEquals(preg_match("[\d{1,3}\.\d{1,3}\.\d{1,3}]",$this->API->getDDragonVersion()),1);
    }
    public function testRequestSummonerIDAndIconIdMethodAndSeeThatSummonerIdAndIconIdIsSet(){
        $this->API->setSummoner("KingMorpheus2131");
        $this->API->requestSummonerIDAndIconId();
        $this->assertTrue(is_int($this->API->getSummonerId()));
        $this->assertTrue(is_int($this->API->getIconId()));
    }

    public function testInjectSummonerIntoApiAndReturnAnObjectWithSummonerSummonerIDAndIcon(){
        $this->API->injectSummoner("KingMorpheus2131");
        $this->assertEquals($this->API->getSummoner(),"KingMorpheus2131");
        $this->assertEquals($this->API->getSummonerId(),'67902786');
        $this->assertNotNull($this->API->getIconID());
        $this->assertNotNull($this->API->getSummonerIcon());
    }

    public function testInjectBadSummonerNameAndGetBackAnException(){
        try{
            $this->API->injectSummoner("djasfhjfghdfsafdafas");
        }catch (\Exception $e){
            $this->assertEquals("Summoner 'djasfhjfghdfsafdafas' is not a valid name in North America",$e->getMessage());
        }
    }

    public function testCallingGetChampionsBeforeCheckingStatusThrowException(){
        $this->API->injectSummoner("KingMorpheus2131");
        $testPass = True;
        try{
            $this->API->getChampion();
            $testPass = false;
        }catch (\Exception $e){
            $this->assertEquals("Call checkCurrentGameStatus before calling this method. KingMorpheus2131 is not in game",$e->getMessage());
        }
        $this->assertTrue($testPass);
    }

}