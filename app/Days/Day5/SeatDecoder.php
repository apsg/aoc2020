<?php
namespace App\Days\Day5;

class SeatDecoder
{
    /** @var int */
    protected $row;

    /** @var int */
    protected $col;

    public function __construct(string $seat)
    {
        $this->row = $this->decodeRow(substr($seat, 0, 7));
        $this->col = $this->decodeColumn(substr($seat, -3));
    }

    protected function decodeRow(string $substr) : int
    {
        return bindec(str_replace(['F', 'B'], ['0', '1'], $substr));
    }

    protected function decodeColumn(string $substr) : int
    {
        return bindec(str_replace(['L', 'R'], ['0', '1'], $substr));
    }

    public function seatId() : int
    {
        return $this->row * 8 + $this->col;
    }
}
