<?php
namespace App\Days\Day2;

class Solver
{
    public static function solve(array $input) : int
    {
        return collect($input)
            ->map(function ($item) {
                return LineParser::parse($item);
            })->filter(function (Line $line) {
                return $line->validate();
            })->count();
    }

    public static function solveTwo(array $input) : int
    {
        return collect($input)
            ->map(function ($item) {
                return LineParser::parse($item);
            })->filter(function (Line $line) {
                return $line->validateTwo();
            })->count();
    }
}
