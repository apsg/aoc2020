<?php
namespace App\Days\Day7;

use Illuminate\Support\Str;

class Parser
{
    public static function parseLine(string $line) : array
    {
        $lineParts = explode('contain', static::removeSurplusStrings($line));

        $bagName = trim($lineParts[0]);
        $containParts = array_map('trim', explode(',', $lineParts[1]));
        $contains = [];

        foreach ($containParts as $part) {
            $number = trim(substr($part, 0, 2));
            $name = trim(substr($part, 2));
            $contains[$name] = $number;
        }

        return [
            $bagName,
            array_filter($contains),
        ];
    }

    public static function removeSurplusStrings(string $line) : string
    {
        return preg_replace([
//            '/[0-9]/',
            '/bags|bag/',
            '/\\./',
            '/no other/',
        ], '', $line);
    }
}
