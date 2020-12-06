<?php
namespace App\Days\Day6;

class Group
{
    /** @var array */
    protected $items = [];

    /**
     * @var array|string[]
     */
    private $declarations;

    public function __construct(string $declarations)
    {
        $this->declarations = explode(PHP_EOL, $declarations);
    }

    public function merge() : self
    {
        foreach ($this->declarations as $declaration) {
            $this->items = array_merge($this->items, str_split($declaration));
        }

        $this->items = array_unique($this->items);

        return $this;
    }

    public function intersect() : self
    {
        $this->items = str_split($this->declarations[0]);

        for ($i = 1; $i < count($this->declarations); $i++) {
            $this->items = array_intersect(
                $this->items,
                str_split($this->declarations[$i])
            );

            if (empty($this->items)) {
                break;
            }
        }

        return $this;
    }

    public function count() : int
    {
        return count($this->items);
    }
}
