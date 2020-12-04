<?php
namespace App\Days\Day2;

class LineParser
{
    public static function parse(string $line) : Line
    {
        [$rules, $password] = explode(': ', $line);
        [$range, $letter] = explode(' ', $rules);
        [$min, $max] = explode('-', $range);

        return new Line($min, $max, $letter, $password);
    }
}
