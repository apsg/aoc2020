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

    public function findError() : ?int
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

    public function findContiguous(int $number) : array
    {
        for ($i = 0; $i < count($this->numbers) - 1; $i++) {
            for ($bin = 2; $bin < count($this->numbers) - 1; $bin++) {
                if (array_sum(array_slice($this->numbers, $i, $bin)) === $number) {
                    return array_slice($this->numbers, $i, $bin);
                }
            }
        }

        return [];
    }

    public function countWeakness() : int
    {
        $error = $this->findError();
        $numbers = $this->findContiguous($error);

        return min($numbers) + max($numbers);
    }
}
