<?php


namespace Fypex\DigisellerClient\Denormalizer\Products;


use Fypex\DigisellerClient\Models\RemoveContentResponseModel;
use Fypex\DigisellerClient\Models\UploadKeysResponseModel;

class RemoveContentDenormalizer
{
    public function denormalize($data): RemoveContentResponseModel
    {
        return new RemoveContentResponseModel($data);
    }
}
