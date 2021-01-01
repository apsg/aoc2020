<?php
namespace App\Days\Day11;

class Solver
{
    const FLOOR = '.';
    const EMPTY = 'L';
    const TAKEN = '#';

    /** @var array */
    protected $seats = [];

    /** @var array */
    protected $newSeats = [];

    /** @var bool */
    protected $hasChangedLastRound = true;

    /** @var int */
    protected $breakCounter = 0;

    public function __construct(array $input)
    {
        $this->seats = $input;
        $this->newSeats = $input;
    }

    public function advanceUntilStable() : self
    {
        while ($this->hasChangedLastRound && $this->breakCounter < 1000) {
            $this->advanceRound();
            $this->breakCounter++;
        }

        return $this;
    }

    public function advanceRound() : self
    {
        for ($i = 0; $i < $this->rowsCount(); $i++) {
            for ($j = 0; $j < $this->colsCount(); $j++) {
                $this->newSeats[$i][$j] = $this->processSeat($i, $j);
            }
        }
        $this->hasChangedLastRound = $this->hasStateChanged();
        $this->seats = $this->newSeats;

        return $this;
    }

    public function countOccupiedSeats() : int
    {
        $count = 0;

        for ($i = 0; $i < $this->rowsCount(); $i++) {
            for ($j = 0; $j < $this->colsCount(); $j++) {
                if ($this->seats[$i][$j] === static::TAKEN) {
                    $count++;
                }
            }
        }

        return $count;
    }

    protected function processSeat(int $row, int $column) : string
    {
        if ($this->seats[$row][$column] === static::FLOOR) {
            return static::FLOOR;
        }

        if ($this->seats[$row][$column] === static::EMPTY
            && $this->countTakenNeighbours($row, $column) === 0) {
            return static::TAKEN;
        }

        if ($this->countTakenNeighbours($row, $column) >= 4) {
            return static::EMPTY;
        }

        return $this->seats[$row][$column];
    }

    protected function countTakenNeighbours(int $row, int $col) : int
    {
        $count = 0;

        for ($i = max(0, $row - 1); $i < min($this->rowsCount(), $row + 2); $i++) {
            for ($j = max(0, $col - 1); $j < min($this->colsCount(), $col + 2); $j++) {
                if ($i === $row && $j === $col) {
                    continue;
                }

                if ($this->seats[$i][$j] === static::TAKEN) {
                    $count++;
                }
            }
        }

        return $count;
    }

    protected function rowsCount() : int
    {
        return count($this->seats);
    }

    protected function colsCount() : int
    {
        return count($this->seats[0]);
    }

    protected function hasStateChanged() : bool
    {
        for ($i = 0; $i < $this->rowsCount(); $i++) {
            for ($j = 0; $j < $this->colsCount(); $j++) {
                if ($this->seats[$i][$j] !== $this->newSeats[$i][$j]) {
                    return true;
                }
            }
        }

        return false;
    }

    public function __toString() : string
    {
        return implode(PHP_EOL,
            array_map(function ($row) {
                return implode('', $row);
            }, $this->seats)
        );
    }
}
