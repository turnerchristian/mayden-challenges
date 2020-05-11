<?php

require_once('./functions.php');

use PHPUnit\Framework\TestCase;

class pairsRequiredCalcDown extends TestCase
{
    public function testThrowsErrorWhenGivenWrongType()
    {
        $this->expectException(TypeError::class);

        pairsRequiredCalcDown(['Hello!']);
    }

    public function testThrowsErrorWhenGivenNoArgument()
    {
        $this->expectException(ArgumentCountError::class);

        pairsRequiredCalcDown();
    }

    public function testSuccessPairsRequiredCalcDown()
    {
        $actual = pairsRequiredCalcDown(7, 1.5, 0.1);
        $expected = 4;
        $this->assertSame($actual, $expected);
    }

}