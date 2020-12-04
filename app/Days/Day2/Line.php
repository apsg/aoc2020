<?php
namespace App\Days\Day2;

use InvalidArgumentException;

class Line
{
    /**
     * @var int
     */
    private $min;
    /**
     * @var int
     */
    private $max;
    /**
     * @var string
     */
    private $letter;
    /**
     * @var string
     */
    private $password;

    public function __construct(int $min, int $max, string $letter, string $password)
    {
        if ($min > $max) {
            throw new InvalidArgumentException('Wrong min-max');
        }

        if (strlen($letter) !== 1) {
            throw new InvalidArgumentException('Only one letter allowed');
        }

        $this->min = $min;
        $this->max = $max;
        $this->letter = $letter;
        $this->password = $password;
    }

    public function validate() : bool
    {
        $filteredString = preg_replace("/[^{$this->letter}]/i", '', $this->password);
        $length = strlen($filteredString);

        return $length >= $this->min && $length <= $this->max;
    }
}
