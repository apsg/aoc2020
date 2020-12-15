<?php
namespace App\Days\Day10;

class Adapters
{
    /** @var int[] */
    protected $voltages;

    /** @var int */
    public $dif1Count = 0;

    /** @var int */
    public $dif3Count = 1;

    public function __construct(array $voltages)
    {
        $this->voltages = array_map(function ($v) {
            return (int)$v;
        }, $voltages);
        sort($this->voltages);
    }

    public function process() : self
    {
        $this->countDifferences(0, $this->voltages[0]);

        for ($i = 1; $i < count($this->voltages); $i++) {
            $this->validate($this->voltages[$i - 1], $this->voltages[$i]);
            $this->countDifferences($this->voltages[$i - 1], $this->voltages[$i]);
        }

        return $this;
    }

    public function getDifferenceProduct() : int
    {
        return $this->dif1Count * $this->dif3Count;
    }

    protected function validate(int $num1, int $num2) : bool
    {
        $difference = abs($num1 - $num2);

        if ($difference >= 1 && $difference <= 3) {
            return true;
        }

        throw new \InvalidArgumentException('Wrong difference');
    }

    private function countDifferences(int $num1, int $num2)
    {
        if (abs($num1 - $num2) === 1) {
            $this->dif1Count++;
        }

        if (abs($num1 - $num2) === 3) {
            $this->dif3Count++;
        }
    }
}
