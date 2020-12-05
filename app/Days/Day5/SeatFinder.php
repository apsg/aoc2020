<?php
namespace App\Days\Day5;

class SeatFinder
{
    /** @var array */
    protected $seats = [];

    public function __construct(int $start, int $end)
    {
        $this->seats = range($start, $end);
    }

    public function markTaken(array $takenSeats) : self
    {
        $this->seats = array_values(array_diff(
            $this->seats,
            array_intersect($this->seats, $takenSeats)
        ));

        return $this;
    }

    public function taken(int $seat) : self
    {
        if (($key = array_search($seat, $this->seats)) !== false) {
            unset($this->seats[$key]);
        }

        return $this;
    }

    public function find()
    {
        for ($i = 0; $i < count($this->seats) - 1; $i++) {
            if (!isset($this->seats[$i])) {
                continue;
            }

            if ($this->seats[$i] === $this->seats[$i + 1] - 1) {
                unset($this->seats[$i]);
                unset($this->seats[$i + 1]);
            }
        }

        return array_values($this->seats)[0];
    }
}
