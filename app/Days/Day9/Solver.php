<?php
namespace App\Days\Day9;

class Solver
{
    /**
     * @var array
     */
    protected $numbers;

    /** @var int */
    protected $window = 25;

    public function __construct(array $numbers)
    {
        $this->numbers = $numbers;
    }

    public function setWindow(int $newWindow) : self
    {
        $this->window = $newWindow;

        return $this;
    }

    public function solve() : ?int
    {
        for ($i = $this->window; $i < count($this->numbers); $i++) {
            if (!$this->check($i)) {
                return $this->numbers[$i];
            }
        }

        return null;
    }

    protected function check(int $index) : bool
    {
        $number = (int)$this->numbers[$index];

        for ($i = 0; $i < $this->window; $i++) {
            for ($j = $i + 1; $j < $this->window; $j++) {
                $sum = $this->numbers[$index - $i - 1] + $this->numbers[$index - $j - 1];
//                dump("adding {$this->numbers[$index - $i - 1]} and {$this->numbers[$index - $j - 1]} = {$sum} ({$number})");
                if ($sum === $number) {
                    return true;
                }
            }
        }

        return false;
    }
}
