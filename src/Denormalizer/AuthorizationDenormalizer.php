<?php

namespace Fypex\DigisellerClient\Denormalizer;


use Fypex\DigisellerClient\Models\Authorization;
use Fypex\DigisellerClient\Models\ProductResponseModel;

class AuthorizationDenormalizer
{
    /**
     * @param $data
     * @return Authorization
     */
    public function denormalize($data): Authorization
    {
        return new Authorization($data);
    }
}
