<?php

namespace RobBrazier\Piwik\Traits;

use PHPUnit\Framework\TestCase;
use RobBrazier\Piwik\Exception\PiwikException;

class FormatTraitTest extends TestCase
{
    /**
     * @var FormatTrait
     */
    private $formatTrait;

    public function setUp(): void
    {
        $this->formatTrait = new FormatTraitStub();
    }

    public function testValidateFormat()
    {
        $input = 'json';
        $output = $this->formatTrait->validateFormat($input);
        $this->assertEquals($input, $output);
    }

    public function testValidateFormatForInvalid()
    {
        $this->expectExceptionMessage("Invalid format [foo]");
        $this->expectException(PiwikException::class);
        $input = 'foo';
        $this->formatTrait->validateFormat($input);
    }
}

class FormatTraitStub
{
    use FormatTrait;
}
