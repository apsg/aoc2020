<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class InputParser
{
    /**
     * @var string
     */
    protected $url;

    protected $data;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function parse()
    {
        $this->data = Http::get($this->url);

        return $this->data;
    }

    public function getData()
    {
        return $this->data;
    }
}
