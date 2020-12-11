<?php
namespace App\Days\Day7;

use Illuminate\Support\Collection;

class Bag
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Collection
     */
    protected $contain;

    public function __construct(string $name, array $contain = [])
    {
        $this->name = $name;
        $this->contain = collect([]);
    }

    public function addContains(array $contains) : self
    {
        $this->contain->push(...$contains);

        return $this;
    }
}
