<?php
namespace App\Days\Day8;

use function Symfony\Component\Translation\t;

class Program
{
    /** @var array */
    protected $instructions;

    /** @var array */
    protected $originalInstructions;

    /** @var int */
    protected $pointer = 0;

    /** @var int */
    protected $accumulator = 0;

    /** @var bool */
    protected $finished = false;

    public function __construct(string $instructions)
    {
        $instructions = explode(PHP_EOL, $instructions);

        $this->instructions = array_map(function ($line) {
            $parts = explode(' ', $line);

            return [
                'instruction' => $parts[0],
                'operator'    => substr($parts[1], 0, 1),
                'value'       => substr($parts[1], 1),
            ];
        }, $instructions);

        $this->originalInstructions = $this->instructions;
    }

    public function fixNextAfter(int $index = 0) : int
    {
        for ($i = $index + 1; $i < count($this->instructions); $i++) {
            if ($this->instructions[$i]['instruction'] === 'nop') {
                $this->instructions[$i]['instruction'] = 'jmp';

                return $i;
            }

            if ($this->instructions[$i]['instruction'] === 'jmp') {
                $this->instructions[$i]['instruction'] = 'nop';

                return $i;
            }
        }

        return $index + 1;
    }

    public function run() : self
    {
        while (!$this->errorOccured() && !$this->shouldTerminate()) {
            $this->processNextInstruction();
        }

        return $this;
    }

    public function getAccumulatorValue() : int
    {
        return $this->accumulator;
    }

    public function hasFinished() : bool
    {
        return $this->finished;
    }

    public function trySolve() : self
    {
        $lastChecked = 0;

        while (!$this->hasFinished()) {
            $this->reset();
            $lastChecked = $this->fixNextAfter($lastChecked);
            $this->run();
        }

        return $this;
    }

    protected function processNextInstruction()
    {
        $this->markAsExecuted();
        call_user_func([$this, 'execute' . ucfirst($this->currentInstruction())]);
    }

    protected function markAsExecuted()
    {
        $this->instructions[$this->pointer]['executed'] = true;
    }

    protected function executeNop()
    {
        $this->pointer++;
    }

    protected function executeAcc()
    {
        $this->accumulator = $this->operate(
            $this->accumulator,
            $this->currentOperator(),
            $this->currentValue()
        );

        $this->pointer++;
    }

    protected function executeJmp()
    {
        $this->pointer = $this->operate(
            $this->pointer,
            $this->currentOperator(),
            $this->currentValue()
        );
    }

    protected function currentInstruction() : string
    {
        return $this->instructions[$this->pointer]['instruction'];
    }

    protected function currentOperator() : string
    {
        return $this->instructions[$this->pointer]['operator'];
    }

    protected function currentValue() : string
    {
        return $this->instructions[$this->pointer]['value'];
    }

    protected function operate(int $input, string $operator, int $value) : int
    {
        if ($operator === '+') {
            return $input + $value;
        }

        if ($operator === '-') {
            return $input - $value;
        }

        return $input;
    }

    protected function errorOccured() : bool
    {
        return !empty($this->instructions[$this->pointer]['executed']);
    }

    protected function shouldTerminate() : bool
    {
        if ($this->pointer === count($this->instructions)) {
            $this->finished = true;

            return true;
        };

        return false;
    }

    protected function reset() : self
    {
        $this->instructions = $this->originalInstructions;
        $this->pointer = 0;
        $this->accumulator = 0;

        return $this;
    }
}
