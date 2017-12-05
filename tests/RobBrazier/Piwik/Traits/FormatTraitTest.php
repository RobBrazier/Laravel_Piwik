<?php

namespace RobBrazier\Piwik\Traits;

use PHPUnit\Framework\TestCase;

class FormatTraitTest extends TestCase
{

    /**
     * @var FormatTrait
     */
    private $formatTrait;

    public function setUp()
    {
        $this->formatTrait = new FormatTraitStub();
    }

    public function testValidateFormat()
    {
        $input = "json";
        $output = $this->formatTrait->validateFormat($input);
        $this->assertEquals($input, $output);
    }

    /**
     * @expectedException \RobBrazier\Piwik\Exception\PiwikException
     * @expectedExceptionMessage Invalid format [foo]
     */
    public function testValidateFormatForInvalid()
    {
        $input = "foo";
        $this->formatTrait->validateFormat($input);
    }

}

class FormatTraitStub
{
    use FormatTrait;
}
