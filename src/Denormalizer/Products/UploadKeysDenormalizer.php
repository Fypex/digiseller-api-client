<?php


namespace Fypex\DigisellerClient\Denormalizer\Products;


use Fypex\DigisellerClient\Models\ProductResponseModel;
use Fypex\DigisellerClient\Models\UploadKeysResponseModel;

class UploadKeysDenormalizer
{
    public function denormalize($data): UploadKeysResponseModel
    {
        return new UploadKeysResponseModel($data);
    }
}
