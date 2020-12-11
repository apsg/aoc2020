<?php
namespace App\Days\Day7;

class BagsCollection
{
    /** @var array */
    public $bags;

    public function __construct()
    {
        $this->bags = [];
    }

    public function processLine(string $line) : self
    {
        [$bagName, $contains] = Parser::parseLine($line);
        $this->bags[$bagName] = $contains;

        return $this;
    }

    public function processManyLines(array $lines) : self
    {
        foreach ($lines as $line) {
            $this->processLine($line);
        }

        return $this;
    }

    public function search(string $name) : int
    {
        $search = [$name];
        $result = 0;

        $result = $this->find($name);

        return count($result);
    }

    protected function find(string $name) : array
    {
        $found = [];

        foreach ($this->bags as $bag => $contains) {
            if (in_array($name, $contains)) {
                $found = array_merge($found, $this->find($bag), [$bag]);
            }
        }

        return array_unique($found);
    }
}
