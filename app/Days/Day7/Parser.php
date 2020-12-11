<?php
namespace App\Days\Day7;

use Illuminate\Support\Str;

class Parser
{
    public static function parseLine(string $line) : array
    {
        $lineParts = explode('contain', static::removeSurplusStrings($line));

        $bagName = trim($lineParts[0]);
        $contains = array_map('trim', explode(',', $lineParts[1]));

        return [
            $bagName,
            array_filter($contains),
        ];
    }

    public static function removeSurplusStrings(string $line) : string
    {
        return preg_replace([
            '/[0-9]/',
            '/bags|bag/',
            '/\\./',
            '/no other/',
        ], '', $line);
    }
}
