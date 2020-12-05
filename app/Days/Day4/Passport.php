<?php
namespace App\Days\Day4;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

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

    public function validate() : bool
    {
        return $this->values
                ->only(static::REQUIRED_FIELDS)
                ->count() === count(static::REQUIRED_FIELDS);
    }

    public function validateDeep() : bool
    {
        foreach (static::REQUIRED_FIELDS as $field) {
            if (!call_user_func([$this, 'validate' . ucfirst($field)])) {
                return false;
            }
        }

        return true;
    }

    protected function validateByr() : bool
    {
        return $this->inRange($this->get('byr'), 1920, 2002);
    }

    protected function validateIyr() : bool
    {
        return $this->inRange($this->get('iyr'), 2010, 2020);
    }

    protected function validateEyr() : bool
    {
        return $this->inRange($this->get('eyr'), 2020, 2030);
    }

    protected function validateHgt() : bool
    {
        $hgt = $this->get('hgt');

        if ($hgt === null) {
            return false;
        }

        if (Str::endsWith($hgt, 'cm')) {
            return $this->inRange(Str::replaceLast('cm', '', $hgt), 150, 193);
        }

        if (Str::endsWith($hgt, 'in')) {
            return $this->inRange(Str::replaceLast('in', '', $hgt), 59, 76);
        }

        return false;
    }

    protected function validateHcl() : bool
    {
        $hcl = $this->get('hcl');

        if ($hcl === null) {
            return false;
        }

        if (strlen($hcl) !== 7) {
            return false;
        }

        return !!preg_match('/\#[a-f0-9]{6}/i', $hcl);
    }

    protected function validateEcl() : bool
    {
        $ecl = $this->get('ecl');

        if ($ecl === null) {
            return false;
        }

        return in_array($ecl, [
            'amb',
            'blu',
            'brn',
            'gry',
            'grn',
            'hzl',
            'oth',
        ]);
    }

    protected function validatePid() : bool
    {
        $pid = $this->get('pid');

        if ($pid === null) {
            return false;
        }

        if (strlen($pid) !== 9) {
            return false;
        }

        return !!preg_match('/[0-9]{9}/i', $pid);
    }

    protected function inRange($value, int $min, int $max) : bool
    {
        if ($value === null) {
            return false;
        }

        return (int)$value >= $min && (int)$value <= $max;
    }
}
