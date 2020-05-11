<?php

require_once('./functions.php');

use PHPUnit\Framework\TestCase;

class minFenceLengthCheck extends TestCase
{
    public function testThrowsErrorWhenGivenWrongType()
    {
        $this->expectException(TypeError::class);

        minFenceLengthCheck(['Hello!']);
    }

    public function testThrowsErrorWhenGivenNoArgument()
    {
        $this->expectException(ArgumentCountError::class);

        minFenceLengthCheck();
    }

    public function testSuccessMinFenceLengthCheck()
    {
        $actual = minFenceLengthCheck(1.5, 1.5, 0.1);
        $expected = false;
        $this->assertSame($actual, $expected);
    }
    public function testSuccessMinFenceLengthCheck2()
    {
        $actual = minFenceLengthCheck(2, 1.5, 0.1);
        $expected = true;
        $this->assertSame($actual, $expected);
    }

}
