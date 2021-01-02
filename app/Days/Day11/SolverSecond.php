<?php
namespace App\Days\Day11;

class SolverSecond extends Solver
{
    const TOLERANCE_THRESHOLD = 5;

    public function countTakenNeighbours(int $row, int $col) : int
    {
        return $this->countLeftNeighbours($row, $col)
            + $this->countRightNeighbours($row, $col)
            + $this->countTopNeighbours($row, $col)
            + $this->countBottomNeighbours($row, $col)
            + $this->countTopLeftDiagonalNeighbours($row, $col)
            + $this->countTopRightDiagonalNeighbours($row, $col)
            + $this->countBottomLeftDiagonalNeighbours($row, $col)
            + $this->countBottomRightDiagonalNeighbours($row, $col);
    }

    protected function countLeftNeighbours(int $row, int $col) : int
    {
        if ($col === 0) {
            return 0;
        }

        for ($i = $col - 1; $i >= 0; $i--) {
            if ($this->seats[$row][$i] === static::TAKEN) {
                return 1;
            }

            if ($this->seats[$row][$i] === static::EMPTY) {
                return 0;
            }
        }

        return 0;
    }

    protected function countRightNeighbours(int $row, int $col)
    {
        if ($col === $this->colsCount() - 1) {
            return 0;
        }

        for ($i = $col + 1; $i < $this->colsCount(); $i++) {
            if ($this->seats[$row][$i] === static::TAKEN) {
                return 1;
            }

            if ($this->seats[$row][$i] === static::EMPTY) {
                return 0;
            }
        }

        return 0;
    }

    protected function countTopNeighbours(int $row, int $col)
    {
        if ($row === 0) {
            return 0;
        }

        for ($i = $row - 1; $i >= 0; $i--) {
            if ($this->seats[$i][$col] === static::TAKEN) {
                return 1;
            }

            if ($this->seats[$i][$col] === static::EMPTY) {
                return 0;
            }
        }

        return 0;
    }

    protected function countBottomNeighbours(int $row, int $col)
    {
        if ($row === $this->rowsCount() - 1) {
            return 0;
        }

        for ($i = $row + 1; $i < $this->rowsCount(); $i++) {
            if ($this->seats[$i][$col] === static::TAKEN) {
                return 1;
            }

            if ($this->seats[$i][$col] === static::EMPTY) {
                return 0;
            }
        }

        return 0;
    }

    protected function countTopLeftDiagonalNeighbours(int $row, int $col)
    {
        $i = 1;
        while ($row - $i >= 0 && $col - $i >= 0) {
            if ($this->seats[$row - $i][$col - $i] === static::TAKEN) {
                return 1;
            }

            if ($this->seats[$row - $i][$col - $i] === static::EMPTY) {
                return 0;
            }
            $i++;
        }

        return 0;
    }

    protected function countTopRightDiagonalNeighbours(int $row, int $col)
    {
        $i = 1;

        while ($row - $i >= 0 && $col + $i < $this->colsCount()) {
            if ($this->seats[$row - $i][$col + $i] === static::TAKEN) {
                return 1;
            }

            if ($this->seats[$row - $i][$col + $i] === static::EMPTY) {
                return 0;
            }
            $i++;
        }

        return 0;
    }

    protected function countBottomLeftDiagonalNeighbours(int $row, int $col)
    {
        $i = 1;
        while ($row + $i < $this->rowsCount() && $col - $i >= 0) {
            if ($this->seats[$row + $i][$col - $i] === static::TAKEN) {
                return 1;
            }

            if ($this->seats[$row + $i][$col - $i] === static::EMPTY) {
                return 0;
            }
            $i++;
        }

        return 0;
    }

    protected function countBottomRightDiagonalNeighbours(int $row, int $col)
    {
        $i = 1;
        while ($row + $i < $this->rowsCount() && $col + $i < $this->colsCount()) {
            if ($this->seats[$row + $i][$col + $i] === static::TAKEN) {
                return 1;
            }

            if ($this->seats[$row + $i][$col + $i] === static::EMPTY) {
                return 0;
            }
            $i++;
        }

        return 0;
    }
}
