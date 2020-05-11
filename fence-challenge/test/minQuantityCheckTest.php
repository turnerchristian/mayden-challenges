<?php

require_once('./functions.php');

use PHPUnit\Framework\TestCase;

class minQuantityCheck extends TestCase
{
    public function testThrowsErrorWhenGivenWrongType()
    {
        $this->expectException(TypeError::class);

        minQuantityCheck(['Hello!']);
    }

    public function testThrowsErrorWhenGivenNoArgument()
    {
        $this->expectException(ArgumentCountError::class);

        minQuantityCheck();
    }

    public function testSuccessMinQuantityCheck()
    {
        $actual = minQuantityCheck(0, 2);
        $expected = false;
        $this->assertSame($actual, $expected);
    }
    public function testSuccessMinQuantityCheck2()
    {
        $actual = minQuantityCheck(1, 8);
        $expected = true;
        $this->assertSame($actual, $expected);
    }

}
