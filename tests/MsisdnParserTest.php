<?php

class MsisdnParserTest extends \PHPUnit\Framework\TestCase
{
    public function testRSCorrectNumber()
    {
        $msisdn = "+38169667323";
        $parser = new \Msisdn\Parser();

        $results = $parser->parse($msisdn);

        $this->assertEquals(true, $results->isValid);
        $this->assertEquals(69667323, $results->number);
        $this->assertEquals(381, $results->countryDilingCode);
        $this->assertEquals("Telenor", $results->mno);
        $this->assertEquals("RS", $results->country);
    }

    public function testUSCorrectNumber()
    {
        $msisdn = "+1 650 253 0000";
        $parser = new \Msisdn\Parser();

        $results = $parser->parse($msisdn);

        $this->assertEquals(true, $results->isValid);
        $this->assertEquals(6502530000, $results->number);
        $this->assertEquals(1, $results->countryDilingCode);
        $this->assertEquals(null, $results->mno);
        $this->assertEquals("US", $results->country);
    }

    public function testInvalidNumber()
    {
        $msisdn = "+1 650 253";
        $parser = new \Msisdn\Parser();

        $results = $parser->parse($msisdn);

        $this->assertEquals(false, $results->isValid);
    }
}