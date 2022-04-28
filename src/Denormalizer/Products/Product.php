<?php

namespace Fypex\DigisellerClient\Denormalizer\Products;

use Fypex\DigisellerClient\Models\ProductResponseModel;

class Product
{

    public function denormalize($data): ProductResponseModel
    {
        return new ProductResponseModel($data);
    }

}
