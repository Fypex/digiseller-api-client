<?php

namespace Fypex\DigisellerClient\Traits;

trait toArrayTrait
{

    /**
     * @return array
     */
    public function toArray(): array
    {
        $values = [];
        foreach ($this as $name => $var){
            $values[$name] = is_object($var) ? $var->toArray() : $var;
        }
        return $values;
    }

}
