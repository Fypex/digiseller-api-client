<?php


namespace Fypex\DigisellerClient\Models\Products;


class UpdateProduct
{

    protected $product_id;
    protected $enabled;

    public static function init(int $product_id): UpdateProduct
    {
        return new static($product_id);
    }

    public function __construct(int $product_id){
        $this->product_id = $product_id;
    }

    public function enabled(bool $bool)
    {
        $this->enabled = $bool;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->product_id;
    }

    /**
     * @return mixed
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

}
