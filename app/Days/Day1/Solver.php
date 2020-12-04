<?php
namespace App\Days\Day1;

class Solver
{
    /**
     * @var array
     */
    protected $input;

    /**
     * @var int[]|array
     */
    protected $found;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function solveForTwo()
    {
        return $this
            ->findTwo()
            ->multiply();
    }

    public function solveForThree()
    {
        return $this
            ->findThree()
            ->multiply();
    }

    private function findTwo() : self
    {
        foreach ($this->input as $id => $value) {
            for ($j = $id + 1; $j < count($this->input); $j++) {
                if ($value + $this->input[$j] === 2020) {
                    $this->found = [$value, $this->input[$j]];

                    return $this;
                }
            }
        }

        throw new \Exception('valid solution not found');
    }

    private function findThree() : self
    {
        foreach ($this->input as $id => $value) {
            for ($j = $id + 1; $j < count($this->input); $j++) {
                for ($k = $j + 1; $k < count($this->input); $k++) {
                    if ($value + $this->input[$j] + $this->input[$k] === 2020) {
                        $this->found = [$value, $this->input[$j], $this->input[$k]];

                        return $this;
                    }
                }
            }
        }

        throw new \Exception('valid solution not found');
    }


    private function multiply() : int
    {
        return array_product($this->found);
    }
}
