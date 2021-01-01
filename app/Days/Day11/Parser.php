<?php
namespace App\Days\Day11;

class Parser
{
    public static function parse(string $input) : array
    {
        $rows = explode(PHP_EOL, $input);

        return array_map('str_split', $rows);
    }
}
