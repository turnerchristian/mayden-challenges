<?php
require_once('./functions.php');

use PHPUnit\Framework\TestCase;

class pairsRequiredCalcUp extends TestCase
{
    public function testThrowsErrorWhenGivenWrongType()
    {
        $this->expectException(TypeError::class);

        pairsRequiredCalcUp(['Hello!']);
    }

    public function testThrowsErrorWhenGivenNoArgument()
    {
        $this->expectException(ArgumentCountError::class);

        pairsRequiredCalcUp();
    }

    public function testSuccessPairsRequiredCalcUp()
    {
        $actual = pairsRequiredCalcUp(7, 1.5, 0.1);
        $expected = 5;
        $this->assertSame($actual, $expected);
    }

}