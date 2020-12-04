<?php
namespace App\Days\Day3;

class PatternParser
{
    public static function parse(string $input) : array
    {
        $lines = explode(PHP_EOL, $input);

        return array_map(function ($line) {
            return static::parseLine($line);
        }, $lines);
    }

    public static function parseLine(string $line) : array
    {
        return str_split(str_replace(['.', '#'], [0, 1], $line));
    }
}
