<?php


namespace Fypex\DigisellerClient\Models;


use Fypex\DigisellerClient\ToArrayAccess;

class Key extends Model
{

    protected $value;
    protected $serial;

    public function __construct(String $key, String $serial = null)
    {
        $this->value = $key;
        $this->serial = $serial;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getSerial(): string
    {
        return $this->serial;
    }

}
