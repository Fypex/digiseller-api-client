<?php

namespace Fypex\DigisellerClient\Denormalizer\Products;

use Fypex\DigisellerClient\Models\ProductResponseModel;

class Products
{

    private $result = [];

    /**
     * @param $products
     * @return array<ProductResponseModel>
     */
    public function denormalize(Array $products): array
    {
        foreach ($products['rows'] as $product){
            array_push($this->result, new ProductResponseModel($product));
        }

        return $this->result;
    }

}
