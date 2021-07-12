<?php

namespace VKEasyFoafTest;

use PHPUnit\Framework\TestCase;
use VKEasyFoaf\Parser;

class ParserTest extends TestCase
{
    protected Parser $parser;

    public function setUp(): void
    {
        $this->parser = new Parser();
    }

    public function testGetPerson(): void
    {
        $this->assertArrayHasKey('Person', $this->parser->foaf(1));
    }

    public function testGetGroup(): void
    {
        $this->assertArrayHasKey('Group', $this->parser->foaf(-1));
    }
}