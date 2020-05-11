<?php

require_once('./functions.php');

use PHPUnit\Framework\TestCase;

class fenceLengthCalcTest extends TestCase
{
    public function testThrowsErrorWhenGivenWrongType()
    {
        $this->expectException(TypeError::class);

        fenceLengthCalc(['Hello!']);
    }

    public function testThrowsErrorWhenGivenNoArgument()
    {
        $this->expectException(ArgumentCountError::class);

        fenceLengthCalc();
    }

    public function testSuccessFenceLengthCalc()
    {
        $actual = fenceLengthCalc(6, 1.5, 0.1);
        $expected = 9.7;
        $this->assertSame($actual, $expected);
    }

}