<?php

namespace Fypex\DigisellerClient\Models;

class Price extends Model
{

    protected $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

}
