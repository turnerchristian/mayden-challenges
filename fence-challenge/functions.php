<?php

function fenceLengthCalc(int $numberOfPairs, float $railUnitLength = 1.5, float $postUnitLength = 0.1): float
{
    return ($numberOfPairs * ($railUnitLength + $postUnitLength)) + $postUnitLength;
}

function pairsRequiredCalcUp(float $fenceLengthInput, float $railUnitLength = 1.5, float $postUnitLength = 0.1): int
{
    return ceil(($fenceLengthInput - ($postUnitLength))/($railUnitLength + $postUnitLength));
}

function pairsRequiredCalcDown(float $fenceLengthInput, float $railUnitLength = 1.5, float $postUnitLength = 0.1): int
{
    return floor(($fenceLengthInput - ($postUnitLength))/($railUnitLength + $postUnitLength));
}

function minFenceLengthCheck(float $fenceLengthInput, float $railUnitLength = 1.5, float $postUnitLength = 0.1): bool
{
    return $fenceLengthInput >= ($railUnitLength + ($postUnitLength * 2));
}

function minQuantityCheck(int $railsInput, int $postsInput): bool
{
    return ($railsInput >= 1) && ($postsInput >= 2);
}


