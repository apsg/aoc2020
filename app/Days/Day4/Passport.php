<?php
namespace App\Days\Day4;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * @see https://adventofcode.com/2020/day/4
 */
class Passport
{
    const FIELDS = [
        'byr' => 'Birth Year',
        'iyr' => 'Issue Year',
        'eyr' => 'Expiration Year',
        'hgt' => 'Height',
        'hcl' => 'Hair Color',
        'ecl' => 'Eye Color',
        'pid' => 'Passport ID',
        'cid' => 'Country ID',
    ];

    const REQUIRED_FIELDS = [
        'byr',
        'iyr',
        'eyr',
        'hgt',
        'hcl',
        'ecl',
        'pid',
    ];

    /** @var array */
    protected $matches = [];

    /** @var Collection */
    protected $values;

    public function __construct(string $passportString)
    {
        preg_match_all(
            $this->matchPattern(),
            $passportString,
            $this->matches,
            PREG_UNMATCHED_AS_NULL
        );

        $this->filterValues();
    }

    /**
     * single key named pattern looks like:
     * /iyr:(?<iyr>[\w\d]+)/
     */
    protected function matchPattern()
    {
        return '/'
            . collect(array_keys(static::FIELDS))
                ->map(function ($key) {
                    return "{$key}:(?<{$key}>[^\s]+)";
                })->implode('|')
            . '/';
    }

    protected function filterValues() : self
    {
        $this->values = collect($this->matches)
            ->only(array_keys(static::FIELDS))
            ->map(function ($array) {
                return array_values(array_filter($array));
            })
            ->filter(function ($item) {
                return !empty($item);
            });

        return $this;
    }

    public function get($key)
    {
        return Arr::get($this->values, $key . '.0', null);
    }

    public function validate()
    {
        return $this->values
                ->only(static::REQUIRED_FIELDS)
                ->count() === count(static::REQUIRED_FIELDS);
    }
}
