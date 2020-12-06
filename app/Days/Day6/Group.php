<?php
namespace App\Days\Day6;

class Group
{
    /** @var array */
    protected $items = [];

    public function __construct(string $declarations)
    {
        $declarations = explode(PHP_EOL, $declarations);

        foreach ($declarations as $declaration) {
            $this->items = array_merge($this->items, str_split($declaration));
        }

        $this->items = array_unique($this->items);
    }

    public function count() : int
    {
        return count($this->items);
    }
}
