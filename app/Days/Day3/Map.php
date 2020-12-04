<?php
namespace App\Days\Day3;

use InvalidArgumentException;

class Map
{
    /** @var array */
    protected $map = [];

    public function __construct(string $input)
    {
        $this->map = PatternParser::parse($input);
    }

    public function get(int $row = 0, int $column = 0) : int
    {
        if ($row > count($this->map) - 1) {
            throw new InvalidArgumentException('Wrong row');
        }

        $columnOffset = $column % $this->columnsCount();

        return $this->map[$row][$columnOffset];
    }

    public function rowsCount() : int
    {
        return count($this->map);
    }

    public function columnsCount() : int
    {
        return count($this->map[0]);
    }

    public function traverse(int $slopeRight, int $slopeDown) : int
    {
        $sum = 0;
        $row = 0;
        $column = 0;

        while ($row < $this->rowsCount() - 1) {
            $row += $slopeDown;
            $column += $slopeRight;
            $sum += $this->get($row, $column);
        }

        return $sum;
    }

    public function traverseMultiple(array $slopes) : array
    {
        return array_map(function (array $coords) {
            return $this->traverse($coords[0], $coords[1]);
        }, $slopes);
    }

    public function solve(array $slopes) : int
    {
        return array_product($this->traverseMultiple($slopes));
    }
}
